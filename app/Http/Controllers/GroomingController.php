<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanGrooming;
use App\Models\Area;
use App\Models\Sop;
use App\Models\User;
use Carbon\Carbon;

class GroomingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grooming = LaporanGrooming::all();
        $title = 'Laporan Grooming Provice Group';
        return view('grooming.index', compact('grooming', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sops = Sop::all();
        $areas = Area::all();
        $title = 'Tambah Data Laporan Grooming Provice Group';
        return view('grooming.create',compact('title', 'areas', 'sops', ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        $imageName = $request->image_lg . '.' . $request->image_lg->extension();
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

        return redirect()->route('laporan-grooming.index')->with('success', 'Berhasil Tambah Laporan Grooming');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
