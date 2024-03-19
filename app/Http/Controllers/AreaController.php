<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        $title = 'Area Kerja Provice Group';
        return view('area.index', compact('areas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Data Area Kerja Provice Group';
        return view('area.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|unique:area',
            'desc_area' => 'required',
        ],[
            'nama_area.required' => 'Nama area tidak boleh kosong',
            'nama_area.unique' => 'Nama area sudah ada',
            'desc_area.required' => 'Deskripsi area tidak boleh kosong',
        ]);

        Area::create([
            'nama_area' => $request->nama_area,
            'desc_area' => $request->desc_area,
        ]);
        return redirect()->route('area.index')->with('success', 'Berhasil Tambah Area Kerja');
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
        $area = Area::find($id);
        $title = 'Ubah Data Area Kerja Provice Group';
        return view('area.edit', compact('area', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $area = Area::findOrFail($id);

        $rules = [
            'nama_area' =>'required',
            'desc_area' =>'required',
        ];

        if($request->nama_area !== $area->nama_area){
            $rules['nama_area'] .= '|unique:area';
        }

        $request->validate($rules,[
            'nama_area.required' => 'Nama area tidak boleh kosong',
            'nama_area.unique' => 'Nama area sudah ada',
            'desc_area.required' => 'Deskripsi area tidak boleh kosong',
        ]);

        Area::find($id)->update([
            'nama_area' => $request->nama_area,
            'desc_area' => $request->desc_area,
        ]);
        
        return redirect()->route('area.index')->with('success', 'Berhasil Ubah Area Kerja');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $area = Area::findorFail($id);
        $area->delete();

        return redirect()->route('area.index')->with('success', 'Area Kerja berhasil dihapus');
    }
}
