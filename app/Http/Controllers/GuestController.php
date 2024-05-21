<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\LaporanGuest;
use App\Models\User;
use Carbon\Carbon;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        return view('guest.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_area' => 'required',
            'nama_guest' => 'required|string',
            'image_guest' =>'required|image|mimes:jpeg,png,jpg,gif',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $imageName = $request->image_guest->getClientOriginalName();
        $request->image_guest->move(public_path('images/laporan_guest/'), $imageName);

        $currentDateTime = Carbon::now();
        LaporanGuest::create([
            'id_area' => $request->id_area,
            'nama_guest' => $request->nama_guest,
            'level_guest' => $request->level_guest,
            'image_guest' => $imageName,
            'tgl_guest' => $currentDateTime,
            'ket_guest' => $request->ket_guest,
        ]);
        return redirect()->route('Guest.create')->with('success', 'Berhasil Tambah Laporan Guest');
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

    public function showAreaResponsibilities()
    {
        $title = 'Daftar Penanggung Jawab Area Kerja';
        $cleaners = User::where('level', 'cleaner')->with('areaResponsibilities')->get();
        return view('guest.index', compact('cleaners', 'title'));
    }
}
