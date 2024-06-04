<?php

namespace App\Http\Controllers;

use App\Events\GuestEvent;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\AreaResponsibility;
use App\Models\LaporanGuest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
                'area_id' => 'required',
                'nama_guest' => 'required|string',
                'ket_guest' => 'required|string',
                'image_guest' =>'required|image|mimes:jpeg,png,jpg,gif',
                'g-recaptcha-response' => 'required|captcha',
            ],[
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

            $Users = User::whereHas('areaResponsibilities', function ($query) use ($request) {
                $query->where('area_id', $request->area_id);
            })->get();

            $firstSupervisorId = $Users->first()->supervisor_id;
            $firstCleanerId = $Users->first()->id_users;

            if ($this->check_internet_connection()) {
                event(new GuestEvent($request->nama_guest, $firstSupervisorId));
                event(new GuestEvent($request->nama_guest, $firstCleanerId));
            }

            $imageName = $request->image_guest->getClientOriginalName();
            $request->image_guest->move(public_path('images/laporan_guest/'), $imageName);

            $currentDateTime = Carbon::now();
            LaporanGuest::create([
                'area_id' => $request->area_id,
                'nama_guest' => $request->nama_guest,
                'level_guest' => $request->filled('level_guest')? $request->level_guest : null,
                'image_guest' => $imageName,
                'tgl_guest' => $currentDateTime,
                'ket_guest' => $request->ket_guest,
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
                                        ->get();

            return view('cleaner.guest.index', compact('laporanGuestCleaner', 'title'));
        }
    //End Cleaner
}
