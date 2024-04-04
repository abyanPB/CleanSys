<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\LaporanGrooming;
use App\Models\TanggapanGrooming;
use App\Models\Area;
use App\Models\Sop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GroomingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $laporan_grooming = TanggapanGrooming::all();
        $laporan_grooming = TanggapanGrooming::whereHas('laporanGrooming', function ($query){
            $query->where('status_lg', '=', 'hasil');
        })->get();
        $title = 'Laporan Grooming Provice Group';
        return view('admin.grooming.index', compact('laporan_grooming' , 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sops = Sop::all();
        $areas = Area::all();
        $lg = LaporanGrooming::findOrFail($id);
        $title = 'Ubah Data Laporan Grooming Provice Group';
        return view('admin.grooming.edit', compact('lg', 'title', 'areas', 'sops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lg = LaporanGrooming::findOrFail($id);

        $request->validate([
            'id_area' =>'required',
            'id_sop' =>'required',
            'status_lg' =>'required',
            'image_lg' => $request->hasFile('image_lg') ? 'required|image|mimes:jpeg,png,jpg,gif' : '',
        ],[
            'id_area.required' => 'Area kerja tidak boleh kosong',
            'id_sop.required' => 'SOP kerja tidak boleh kosong',
            'status_lg.required' => 'Status pekerjaan tidak boleh kosong',
            'image_lg.required' => 'Foto pekerjaan tidak boleh kosong',
            'image_lg.image' => 'File harus berupa gambar',
            'image_lg.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, atau gif',
        ]);

        $lg->id_area = $request->id_area;
        $lg->id_sop = $request->id_sop;
        $lg->status_lg = $request->status_lg;

        if($request->hasFile('image_lg')){
            File::delete(public_path('images/laporan_grooming/'. $lg->image_lg));
            $imageName = $request->image_lg->getClientOriginalName();
            $request->image_lg->move(public_path('images/laporan_grooming/'), $imageName);
            $lg->image_lg = $imageName;
        };

        $lg->save();

        return redirect()->route('laporan-grooming.index')->with('success', 'Berhasil Ubah Laporan Grooming');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lg = LaporanGrooming::findOrFail($id);
        $path = 'images/laporan_grooming/';

        File::delete(public_path($path . $lg['image_lg']));
        $lg->delete();

        return redirect()->route('laporan-grooming.index')->with('success', 'Laporan Grooming berhasil dihapus');
    }

    public function showTanggapanGroomingSupervisor(Request $request)
    {
        $tanggalHariIni = now()->toDateString(); // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        $laporanHariIni = LaporanGrooming::whereDate('tgl_lg', $tanggalHariIni)->orderByDesc('tgl_lg')->get();
        $title = 'Tanggapan Grooming Supervisor Provice Group';
        return view('supervisor.grooming.index', compact('laporanHariIni', 'title'));
    }

    public function inputTanggapanGroomingSupervisor(Request $request)
    {
        $request->validate([
            'tanggapan_grooming'=>'required',
        ],[
            'tanggapan_grooming.required' => 'Tanggapan Grooming tidak boleh kosong',
        ]);
        $currentDateTime = Carbon::now();
        $user_id = Auth::id();

        TanggapanGrooming::create([
            'id_lg' => $request->id_lg,
            'tgl_tg' => $currentDateTime,
            'tanggapan_grooming' => $request->tanggapan_grooming,
            'id_users' => $user_id,
        ]);

        return redirect()->route('showTanggapanGrooming')->with('success', 'Berhasil Menanggapi Laporan Grooming');
    }

    public function showLaporanGroomingCleaner(Request $request)
    {
        $user = $request->user()->id_users;
        $tanggalHariIni = now()->toDateString();
        $laporanCleaner = LaporanGrooming::where('id_users', $user)
                                        ->whereDate('created_at', $tanggalHariIni)
                                        ->get();
        $title = 'Laporan Grooming Cleaner Provice Group';
        return view('cleaner.grooming.index', compact('laporanCleaner', 'title'));
    }

    public function createLaporanGroomingCleaner()
    {
        $sops = Sop::all();
        $areas = Area::all();
        $title = 'Tambah Data Laporan Grooming Provice Group';
        return view('cleaner.grooming.create',compact('title', 'areas', 'sops', ));
    }

    public function storeLaporanGroomingCleaner(Request $request)
    {
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

        // $q = Sop::where('image_lg','=',$request->image_lg)->count();
        // if ($q > 0) {
        //     return redirect()->back();
        // }

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

    public function destroyLaporanGroomingCleaner(string $id)
    {
        $lg = LaporanGrooming::findOrFail($id);
        $path = 'images/laporan_grooming/';

        File::delete(public_path($path . $lg['image_lg']));
        $lg->delete();

        return redirect()->route('showLaporanGroomingCleaner')->with('success', 'Laporan Grooming berhasil dihapus');
    }
}
