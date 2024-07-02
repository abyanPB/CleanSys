<?php

namespace App\Http\Controllers;

use App\Events\GuestEvent;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\AreaResponsibility;
use App\Models\LaporanGuest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
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
            $title = 'Daftar Laporan Pengaduan Pelayanan Admin';
            $laporanGuestAdmin = LaporanGuest::orderByDesc('tgl_guest')->get();
            return view('admin.guest.index', compact('laporanGuestAdmin', 'title'));
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $pelayanan = LaporanGuest::findOrFail($id);
            $path = 'images/laporan_guest/';
            File::delete(public_path($path . $pelayanan['image_guest']));
            $pelayanan->delete();
            return redirect()->route('laporan-pelayanan.index')->with('success', 'Laporan Pelayanan berhasil dihapus');
        }

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
            $selectedJenis = $request->input('selected_jenis',[]);//Mendaparkan inputan jenis laporan dari inputan
            if (!is_array($selectedJenis)) {
                $selectedJenis = explode(',', $selectedJenis); // Pastikan $selectedJenis adalah array
            }

            //Validasi tanggal
            if (($request->start_date == '') || ($request->end_date == '')) {
                return redirect()->route('laporan-pelayanan.index')->with('error','Cetak gagal ! Harap isi kedua tanggal !');
            }

            $startDate = $request->start_date;
            $endDate = now()->parse($request->end_date)->addDay();

            if (empty($selectedJenis)) {
                $printData = LaporanGuest::whereBetween('tgl_guest', [$startDate, $endDate])->get();
            } else {
                $printData = LaporanGuest::whereIn('jenis_laporan', $selectedJenis)
                                        ->whereBetween('tgl_guest', [$startDate, $endDate])
                                        ->get();
            }
                $title = 'Laporan Pengaduan Pelayanan PT Provice Group';
                $nameMonthYear = $this->getMonthYearName($request->start_date, $request->end_date);
                $pdf = Pdf::loadView('admin.guest.pdf',compact('printData', 'title', 'nameMonthYear'))->setPaper('A4', 'landscape');
                return $pdf->download("$title - $request->start_date - $request->end_date");
        }
    //End Admin

    //Start Guest
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $areas = Area::all();
            $title = 'Laporan Pengaduan Provice Groupe';
            return view('guest.create', compact('areas', 'title'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $request->validate([
                'jenis_laporan' => 'required',
                'area_id' => 'required',
                'nama_guest' => 'required|string',
                'ket_guest' => 'required|string',
                'image_guest' =>'required|image|mimes:jpeg,png,jpg,gif',
                'g-recaptcha-response' => 'required|captcha',
            ],[
                'jenis_laporan.required' => 'Jenis Laporan tidak boleh kosong',
                'area_id.required' => 'Area kerja tidak boleh kosong',
                'nama_guest.required' => 'Nama guest tidak boleh kosong',
                'nama_guest.string' => 'Nama guest harus berupa string',
                'ket_guest.required' => 'Keterangan guest tidak boleh kosong',
                'ket_guest.string' => 'Keterangan guest harus berupa string',
                'image_guest.required' => 'Foto guest tidak boleh kosong',
                'image_guest.image' => 'File harus berupa gambar',
                'image_guest.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, atau gif',
                'g-recaptcha-response.required' => 'Captcha tidak boleh kosong',
            ]);

            // Periksa apakah ada laporan lain dari area yang sama dalam 1 jam atau 30 Menit terakhir
            $oneHourAgo = Carbon::now()->subHour(); //Kalau 1 Jam
            // $halfHourAgo = Carbon::now()->subMinutes(30); //Kalau 30 Menit
            $existingReport = LaporanGuest::where('area_id', $request->area_id)
                                        ->where('tgl_guest', '>=', $oneHourAgo)
                                        ->first();

            if ($existingReport) {
                $remainingTime = Carbon::parse($existingReport->tgl_guest)->addHour()->diffForHumans([
                // $remainingTime = Carbon::parse($existingReport->tgl_guest)->addMinutes(30)->diffForHumans([
                    'parts' => 2,
                    'join' => ', ',
                    'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
                    'options' => Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS,
                ]);

                return redirect()->route('Guest.create')->with('error', 'Laporan sudah dibuat dalam waktu 1 jam terakhir. Anda dapat membuat laporan baru dalam ' . $remainingTime . '.');
                // return redirect()->route('Guest.create')->with('error', 'Laporan sudah dibuat dalam waktu 30 menit terakhir. Anda dapat membuat laporan baru dalam ' . $remainingTime . '.');
            }

            // Mengambil user dengan tanggung jawab di area yang dipilih
            $Users = User::whereHas('areaResponsibilities', function ($query) use ($request) {
                $query->where('area_id', $request->area_id);
            })->get();

            // Ambil id supervisor dan cleaner pertama
            $firstSupervisorId = $Users->first()->supervisor_id;
            $firstCleanerId = $Users->first()->id_users;

            // Kirim event jika terhubung ke internet
            if ($this->check_internet_connection()) {
                event(new GuestEvent($request->nama_guest, $firstSupervisorId));
                event(new GuestEvent($request->nama_guest, $firstCleanerId));
            }

            // Simpan gambar
            $imageName = $request->image_guest->getClientOriginalName();
            $request->image_guest->move(public_path('images/laporan_guest/'), $imageName);

            // Simpan laporan
            $currentDateTime = Carbon::now();
            LaporanGuest::create([
                'jenis_laporan' => $request->jenis_laporan,
                'area_id' => $request->area_id,
                'nama_guest' => $request->nama_guest,
                'level_guest' => $request->filled('level_guest')? $request->level_guest : null,
                'image_guest' => $imageName,
                'tgl_guest' => $currentDateTime,
                'ket_guest' => $request->ket_guest,
                'status_laporan' => 'belum',
            ]);
            return redirect()->route('Guest.create')->with('success', 'Berhasil Tambah Laporan Guest');
        }
    //End Guest

    //Start Supervisor
        public function showPelayananSpv()
        {
            $user = Auth::user();
            $currentDate = now()->toDateString();
            $title = 'Daftar Laporan Pengaduan SPV';

            // Dapatkan semua id_area dari area_responsibilities yang dihubungkan dengan user yang diawasi oleh SPV yang sedang login
            $areaIds = AreaResponsibility::whereHas('user', function ($query) use ($user) {
                $query->where('supervisor_id', $user->id_users);
            })->pluck('area_id');

            // Dapatkan semua laporan pengaduan berdasarkan id_area
            $laporanGuestSpv = LaporanGuest::whereIn('area_id', $areaIds)
                                        ->whereDate('tgl_guest', $currentDate)
                                        ->orderByDesc('tgl_guest')
                                        ->get();

            return view('supervisor.guest.index', compact('laporanGuestSpv', 'title'));
        }
    //End Supervisor

    //Start Cleaner
        public function showPelayananCleaner()
        {
            $user = Auth::user();
            $currentDate = now()->toDateString();
            $title = 'Daftar Laporan Pengaduan SPV';

            // Dapatkan semua id_area dari area_responsibilities yang dihubungkan dengan user yang diawasi oleh SPV yang sedang login
            $areaIds = AreaResponsibility::whereHas('user', function ($query) use ($user) {
                $query->where('id_users', $user->id_users);
            })->pluck('area_id');

            // Dapatkan semua laporan pengaduan berdasarkan id_area
            $laporanGuestCleaner = LaporanGuest::whereIn('area_id', $areaIds)
                                        ->whereDate('tgl_guest', $currentDate)
                                        ->orderByDesc('tgl_guest')
                                        ->where('jenis_laporan', 'pelayanan')
                                        ->get();

            return view('cleaner.guest.index', compact('laporanGuestCleaner', 'title'));
        }

        public function storePelayananCleaner(Request $request)
        {
            $lGc = LaporanGuest::findOrFail($request->id_guest);
            $lGc->status_laporan = 'terbaca';
            $lGc->save();
            return redirect()->route('showPelayananCleaner')->with('success', 'Berhasil Tandai Laporan Pelayanan Menjadi Terbaca');
        }
    //End Cleaner
}
