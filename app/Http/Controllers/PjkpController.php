<?php

namespace App\Http\Controllers;

use App\Events\LaporanPjkpEvent;
use App\Models\Area;
use App\Models\LaporanGrooming;
use App\Models\LaporanPJKP;
use App\Models\Sop;
use App\Models\TanggapanPJKP;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PjkpController extends Controller
{

    /**
     * Fungsi untuk memeriksa koneksi internet.
     * Mengembalikan true jika terhubung ke internet, dan false jika tidak.
     */
    private function check_internet_connection() {
        $connected = @fsockopen("www.google.com", 80); // Mencoba membuka koneksi ke google
        if ($connected) {
            fclose($connected);
            return true; // Terhubung ke internet
        } else {
            return false; // Tidak terhubung ke internet
        }
    }

    //Start Admin
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $adminPjkpReport = TanggapanPJKP::whereHas('laporanPjkp', function ($query){
                $query->where('status_lp', '=', 'hasil');
            })->orderBy('tgl_tp', 'desc')->get();
            $Users = User::where('level', '=', 'cleaner')->get();
            $title = 'Laporan PJKP Provice Group';
            return view('admin.pjkp.index', compact('adminPjkpReport' , 'title', 'Users'));
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $pjkp = LaporanPJKP::findOrFail($id);
            $path = 'images/laporan_pjkp/';
            File::delete(public_path($path . $pjkp['image_lp']), true);
            $pjkp->delete();
            return redirect()->route('laporan-pjkp.index')->with('success', 'Laporan Pjkp berhasil dihapus');
        }

        //Mendapatkan Bulan dan Tahun Untuk Laporan
        private function getMonthYearName($startDate, $endDate) {
            $startMonth = date('F', strtotime($startDate)); // Ambil nama bulan dari tanggal awal
            $startYear = date('Y', strtotime($startDate)); // Ambil tahun dari tanggal awal

            $endMonth = date('F', strtotime($endDate)); // Ambil nama bulan dari tanggal akhir
            $endYear = date('Y', strtotime($endDate)); // Ambil tahun dari tanggal akhir

            if ($startMonth == $endMonth && $startYear == $endYear) {
                // Jika bulan dan tahun sama, tampilkan hanya satu bulan dan tahun
                return "$startMonth $startYear";
            } else {
                // Jika berbeda, tampilkan rentang bulan dan tahun
                return "$startMonth $startYear - $endMonth $endYear";
            }
        }

        //Fungsi untuk mencetak PDF
        public function generatePdf(Request $request){
            $selectedUsers = $request->input('selected_users',[]);//Mendaparkan inputan user dari inputan

            //Validasi tanggal
            if (($request->start_date == '') || ($request->end_date == '')) {
                return redirect()->route('laporan-pjkp.index')->with('error','Cetak gagal ! Harap isi kedua tanggal !');
            }else{
                //Jika tidak ada pekerja dipilih, maka cetak semua
                if ($selectedUsers == null){
                    $printData = TanggapanPJKP::whereHas('laporanPjkp', function ($query){
                        $query->where('status_lp', '=', 'hasil');
                    })->whereBetween('tgl_tp', [$request->start_date, now()->parse($request->end_date)->addDay()])->get();
                }
                //Cetak berdasarkan nama pekerja yang dipilih
                else{
                    $printData = TanggapanPJKP::whereHas('laporanPjkp', function ($query) use ($selectedUsers){
                        $query->where('status_lp', '=', 'hasil');
                        $query->whereIn('id_users', $selectedUsers);
                    })->whereBetween('tgl_tp', [$request->start_date, now()->parse($request->end_date)->addDay()])->get();
                }
                $title = 'Laporan PJKP Provice Group';
                $nameMonthYear = $this->getMonthYearName($request->start_date, $request->end_date);
                $pdf = Pdf::loadView('admin.pjkp.pdf',compact('printData', 'title', 'nameMonthYear'));
                return $pdf->stream("$title - $request->start_date - $request->end_date");
            }
        }
    //End Admin

    //Start Supervisor
        public function indexPjkpResponseSupervisor(Request $request)
        {
            $todayDate = now()->toDateString(); // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
            $user = Auth::user();
            $supervisorPjkpReportToday = LaporanPJKP::whereHas('user', function ($query) use ($user){
                $query->where('supervisor_id', $user->id_users);
            })->whereDate('tgl_lp', $todayDate)->orderByDesc('tgl_lp')->get();
            $title = 'Tanggapan PJKP Supervisor Provice Group';
            return view('supervisor.pjkp.index', compact('supervisorPjkpReportToday', 'title'));
        }

        public function storePjkpResponseSupervisor(Request $request)
        {
            // Emit an event with the supervisor's name
            $user = Auth::user();
            $laporanPjkp = LaporanPJKP::findOrFail($request->id_lp);
            $laporanOwnerId = $laporanPjkp->user_id;
            if($this->check_internet_connection()) {
                event(new LaporanPjkpEvent($user->name, $laporanOwnerId));
            }

            $request->validate([
                'tanggapan_pjkp'=>'required',
            ],[
                'tanggapan_pjkp.required' => 'Tanggapan Pjkp tidak boleh kosong',
            ]);
            $currentDateTime = Carbon::now();
            TanggapanPJKP::create([
                'lp_id' => $request->id_lp,
                'tgl_tp' => $currentDateTime,
                'tanggapan_pjkp' => $request->tanggapan_pjkp,
                'user_id' => Auth::id(),
            ]);
            return redirect()->route('showTanggapanPjkp')->with('success', 'Berhasil Menanggapi Laporan Pjkp');
        }
    //End Supervisor

    //Start Cleaner
        public function indexPjkpDailyReportCleaner(Request $request)
        {
            $userId = Auth::user()->id_users;
            $currentDate = now()->toDateString();
            $cleanerPjkpReportToday = LaporanPJKP::where('user_id', $userId)
                                            ->whereDate('tgl_lp', $currentDate)
                                            ->orderBydesc('tgl_lp')
                                            ->get();
            $title = 'Laporan Pjkp Cleaner Provice Group';
            return view('cleaner.pjkp.index', compact('cleanerPjkpReportToday', 'title'));
        }

        public function createPjkpDailyReportCleaner()
        {
            $sops = Sop::all();
            $areas = Area::all();
            $title = 'Tambah Data Laporan Harian Pjkp - Provice Group';
            return view('cleaner.pjkp.create',compact('title', 'areas', 'sops'));
        }

        public function storePjkpDailyReportCleaner(Request $request)
        {
            // Emit an event with the supervisor's name
            $user = Auth::user();
            if ($this->check_internet_connection()){
                event(new LaporanPjkpEvent($user->name, $user->supervisor_id));
            }

            $request->validate([
                'area_id' =>'required',
                'sop_id' =>'required',
                'status_lp' =>'required',
                'image_lp' =>'required|image|mimes:jpeg,png,jpg,gif',
            ],[
                'area_id.required' => 'Area kerja tidak boleh kosong',
                'sop_id.required' => 'SOP kerja tidak boleh kosong',
                'status_lp.required' => 'Status pekerjaan tidak boleh kosong',
                'image_lp.required' => 'Foto pekerjaan tidak boleh kosong',
                'image_lp.image' => 'File harus berupa gambar',
                'image_lp.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, atau gif',
            ]);
            $imageName = $request->image_lp->getClientOriginalName();
            $request->image_lp->move(public_path('images/laporan_pjkp/'), $imageName);

            $currentDateTime = Carbon::now();
            LaporanPJKP::create([
                'user_id' => $request->user_id,
                'area_id' => $request->area_id,
                'sop_id' => $request->sop_id,
                'tgl_lp' => $currentDateTime,
                'image_lp' => $imageName,
                'status_lp' => $request->status_lp,
            ]);
            return redirect()->route('showLaporanPjkpCleaner')->with('success', 'Berhasil Tambah Laporan Pjkp');
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function editPjkpDailyReportCleaner(string $id)
        {
            $sops = Sop::all();
            $areas = Area::all();
            $lp = LaporanPJKP::findOrFail($id);
            $title = 'Ubah Data Laporan Harian Pjkp - Provice Group';
            return view('cleaner.pjkp.edit', compact('lp', 'title', 'areas', 'sops'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function updatePjkpDailyReportCleaner(Request $request, string $id)
        {
            $lp = LaporanPJKP::findOrFail($id);

            $request->validate([
                'area_id' =>'required',
                'sop_id' =>'required',
                'status_lp' =>'required',
                'image_lp' => $request->hasFile('image_lp') ? 'image|mimes:jpeg,png,jpg,gif' : '',
            ],[
                'area_id.required' => 'Area kerja tidak boleh kosong',
                'sop_id.required' => 'SOP kerja tidak boleh kosong',
                'status_lp.required' => 'Status pekerjaan tidak boleh kosong',
                'image_lp.image' => 'File harus berupa gambar',
                'image_lp.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, atau gif',
            ]);

            $lp->area_id = $request->area_id;
            $lp->sop_id = $request->sop_id;
            $lp->status_lp = $request->status_lp;

            if($request->hasFile('image_lp')){
                // Delete the old image before uploading the new one
                File::delete(public_path('images/laporan_grooming/'. $lp->image_lp));

                // Move and save the new image
                $imageName = $request->image_lp->getClientOriginalName();
                $request->image_lp->move(public_path('images/laporan_grooming/'), $imageName);
                $lp->image_lp = $imageName;
            };

            $lp->save();

            return redirect()->route('showLaporanPjkpCleaner')->with('success', 'Berhasil Ubah Laporan Grooming');
        }

        public function destroyPjkpDailyReportCleaner(string $id)
        {
            $lp = LaporanPJKP::findOrFail($id);
            $path = 'images/laporan_pjkp/';
            File::delete(public_path($path . $lp['image_lp']));
            $lp->delete();
            return redirect()->route('showLaporanPjkpCleaner')->with('success', 'Laporan Pjkp berhasil dihapus');
        }
    //End Cleaner
}
