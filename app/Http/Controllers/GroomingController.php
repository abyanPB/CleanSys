<?php

namespace App\Http\Controllers;

use App\Events\LaporanGroomingEvent;
use App\Models\Area;
use App\Models\LaporanGrooming;
use App\Models\Sop;
use App\Models\TanggapanGrooming;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;
use Termwind\Components\Dd;

class GroomingController extends Controller
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
            $adminGroomingReport = TanggapanGrooming::whereHas('laporanGrooming', function ($query){
                $query->where('status_lg', '=', 'hasil');
            })->orderBy('tgl_tg', 'desc')->get();
            $Users = User::where('level', '=', 'cleaner')->get();
            $title = 'Laporan Grooming Provice Group';
            return view('admin.grooming.index', compact('adminGroomingReport' , 'title', 'Users'));
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $grooming = LaporanGrooming::findOrFail($id);
            $path = 'images/laporan_grooming/';
            File::delete(public_path($path . $grooming['image_lg']));
            $grooming->delete();
            return redirect()->route('laporan-grooming.index')->with('success', 'Laporan Grooming berhasil dihapus');
        }

        function getMonthYearName($startDate, $endDate) {
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
                return redirect()->route('laporan-grooming.index')->with('error','Cetak gagal ! Harap isi kedua tanggal !');
            }else{
                //Jika tidak ada pekerja dipilih, maka cetak semua
                if ($selectedUsers == null){
                    $printData = TanggapanGrooming::whereHas('laporanGrooming', function ($query){
                        $query->where('status_lg', '=', 'hasil');
                    })->whereBetween('tgl_tg', [$request->start_date, now()->parse($request->end_date)->addDay()])->get();
                }
                //Cetak berdasarkan nama pekerja yang dipilih
                else{
                    $printData = TanggapanGrooming::whereHas('laporanGrooming', function ($query) use ($selectedUsers){
                        $query->where('status_lg', '=', 'hasil');
                        $query->whereIn('id_users', $selectedUsers);
                    })->whereBetween('tgl_tg', [$request->start_date, now()->parse($request->end_date)->addDay()])->get();
                }
                $title = 'Laporan Grooming Provice Group';
                $nameMonthYear = $this->getMonthYearName($request->start_date, $request->end_date);
                $pdf = Pdf::loadView('admin.grooming.pdf',compact('printData', 'title', 'nameMonthYear'));
                return $pdf->stream("$title - $request->start_date - $request->end_date");
            }
        }
    //End Admin

    //Start Supervisor
        /**
         * Show the form for creating a new resource.
         * Index Supervisor Grooming Rensponse Report.
         */
        public function indexGroomingResponseSupervisor(Request $request)
        {
            $todayDate = now()->toDateString(); // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
            $user = Auth::user();
            $supervisorGroomingReportToday = LaporanGrooming::whereHas('user', function ($query) use ($user) {
                $query->where('supervisor_id', $user->id_users);
            })->whereDate('tgl_lg', $todayDate)->orderByDesc('tgl_lg')->get();
            $title = 'Tanggapan Grooming Supervisor Provice Group';
            return view('supervisor.grooming.index', compact('supervisorGroomingReportToday', 'title'));
        }

        /**
         * Store a newly created resource in storage.
         * Store Supervisor Grooming Rensponse Report.
         */
        public function storeGroomingResponseSupervisor(Request $request)
        {
            // Emit an event with the supervisor's name
            $user = Auth::user();
            $laporanGrooming = LaporanGrooming::findOrFail($request->id_lg);
            $laporanOwnerId = $laporanGrooming->id_users;
            if ($this->check_internet_connection()) {
                event(new LaporanGroomingEvent($user->name, $laporanOwnerId));
            }

            $request->validate([
                'tanggapan_grooming'=>'required',
            ],[
                'tanggapan_grooming.required' => 'Tanggapan Grooming tidak boleh kosong',
            ]);
            $currentDateTime = Carbon::now();//inisialisasi date
            TanggapanGrooming::create([
                'id_lg' => $request->id_lg,
                'tgl_tg' => $currentDateTime,
                'tanggapan_grooming' => $request->tanggapan_grooming,
                'id_users' => Auth::id(),
            ]);
            return redirect()->route('showTanggapanGrooming')->with('success', 'Berhasil Menanggapi Laporan Grooming');
        }
    //End Supervisor

    //Start Cleaner
        /**
         * Show the form for creating a new resource.
         * Index Cleaner Grooming Report Daily.
         */
        public function indexGroomingDailyReportCleaner(Request $request)
        {
            $userId = Auth::user()->id_users;
            $currentDate = now()->toDateString();
            $cleanerGroomingReportToday = LaporanGrooming::where('id_users', $userId)
                                            ->whereDate('tgl_lg', $currentDate)
                                            ->orderBydesc('tgl_lg')
                                            ->get();
            $title = 'Laporan Harian Grooming Cleaning Service - Provice Group';
            return view('cleaner.grooming.index', compact('cleanerGroomingReportToday', 'title'));
        }

        public function createGroomingDailyReportCleaner()
        {
            $sops = Sop::all();
            $areas = Area::all();
            $title = 'Tambah Data Laporan Harian Grooming - Provice Group';
            return view('cleaner.grooming.create',compact('title', 'areas', 'sops', ));
        }

        public function storeGroomingDailyReportCleaner(Request $request)
        {
            $user = Auth::user();

            if ($this->check_internet_connection()) {
                event(new LaporanGroomingEvent($user->name, $user->supervisor_id));
            }

            $request->validate([
                'id_area' =>'required',
                'id_sop' =>'required',
                'status_lg' =>'required',
                'image_lg' =>'required|image|mimes:jpeg,png,jpg,gif',
            ],[
                'id_area.required' => 'Area kerja tidak boleh kosong',
                'id_sop.required' => 'SOP kerja tidak boleh kosong',
                'status_lg.required' => 'Status pekerjaan tidak boleh kosong',
                'image_lg.required' => 'Foto pekerjaan tidak boleh kosong',
                'image_lg.image' => 'File harus berupa gambar',
                'image_lg.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, atau gif',
            ]);
            $imageName = $request->image_lg->getClientOriginalName();
            $request->image_lg->move(public_path('images/laporan_grooming/'), $imageName);

            $currentDateTime = Carbon::now();
            LaporanGrooming::create([
                'id_users' => $request->id_users,
                'id_area' => $request->id_area,
                'id_sop' => $request->id_sop,
                'tgl_lg' => $currentDateTime,
                'image_lg' => $imageName,
                'status_lg' => $request->status_lg,
            ]);
            return redirect()->route('showLaporanGroomingCleaner')->with('success', 'Berhasil Tambah Laporan Grooming');
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function editGroomingDailyReportCleaner(string $id)
        {
            $sops = Sop::all();
            $areas = Area::all();
            $lg = LaporanGrooming::findOrFail($id);
            $title = 'Ubah Data Laporan Harian Grooming - Provice Group';
            return view('cleaner.grooming.edit', compact('lg', 'title', 'areas', 'sops'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function updateGroomingDailyReportCleaner(Request $request, string $id)
        {
            $lg = LaporanGrooming::findOrFail($id);

            $request->validate([
                'id_area' =>'required',
                'id_sop' =>'required',
                'status_lg' =>'required',
                'image_lg' => $request->hasFile('image_lg') ? 'image|mimes:jpeg,png,jpg,gif' : '',
            ],[
                'id_area.required' => 'Area kerja tidak boleh kosong',
                'id_sop.required' => 'SOP kerja tidak boleh kosong',
                'status_lg.required' => 'Status pekerjaan tidak boleh kosong',
                'image_lg.image' => 'File harus berupa gambar',
                'image_lg.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, atau gif',
            ]);

            $lg->id_area = $request->id_area;
            $lg->id_sop = $request->id_sop;
            $lg->status_lg = $request->status_lg;

            if($request->hasFile('image_lg')){
                // Delete the old image before uploading the new one
                File::delete(public_path('images/laporan_grooming/'. $lg->image_lg));

                // Move and save the new image
                $imageName = $request->image_lg->getClientOriginalName();
                $request->image_lg->move(public_path('images/laporan_grooming/'), $imageName);
                $lg->image_lg = $imageName;
            };

            $lg->save();

            return redirect()->route('showLaporanGroomingCleaner')->with('success', 'Berhasil Ubah Laporan Grooming');
        }

        public function destroyGroomingDailyReportCleaner(string $id)
        {
            $lg = LaporanGrooming::findOrFail($id);
            $path = 'images/laporan_grooming/';
            File::delete(public_path($path . $lg['image_lg']));
            $lg->delete();
            return redirect()->route('showLaporanGroomingCleaner')->with('success', 'Laporan Grooming berhasil dihapus');
        }
    //End Cleaner
}
