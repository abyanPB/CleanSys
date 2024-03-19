<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop;
use Illuminate\Support\Facades\File;


class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sops = Sop::all();
        $title = 'SOP Provice Group';
        return view('sop.index',compact('title','sops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Data SOP Provice Group';
        return view('sop.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_sop' => 'required|unique:sop',
            'ket_sop' => 'required',
            'image_sop' => 'required','mimes:jpg,bmp,png,jpeg,svg|max:2048',
        ],[
            'nama_sop.required' => 'Harap masukan nama SOP',
            'nama_sop.unique' => 'Nama SOP sudah ada',
            'ket_sop.required' => 'Harap masukan keterangan SOP',
            'image_sop.required' => 'Harap masukan foto SOP',
            'image_sop.mimes' => 'File yang anda masukan bukan file jpg,bmp,png,jpeg,svg',
            'image_sop.max' => 'Ukuran file yang anda masukan melebihi 2MB',
        ]);

        $imageName = $request->nama_sop . '.' . $request->image_sop->extension();
        $request->image_sop->move(public_path('images/sop/'), $imageName);

        $q = Sop::where('image_sop','=',$request->image_sop)->count();
        if ($q > 0) {
            return redirect()->back();
        }

        Sop::create([
            'nama_sop' => $request->nama_sop,
            'ket_sop' => $request->ket_sop,
            'image_sop' => $imageName,
        ]);

        return redirect()->route('sop.index')->with('success', 'Berhasil Tambah SOP Pekerjaan');
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
        $sop = Sop::findOrFail($id);
        $title = 'Ubah Data SOP';
        return view('sop.edit', compact('sop', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sop = Sop::findOrFail($id);

        $rules = [
            'nama_sop' => 'required',
            'ket_sop' => 'required',
            'image_sop' => $request->hasFile('image_sop') ? 'required|mimes:jpg,bmp,png,jpeg,svg|max:2048' : '',
        ];

        if($request->nama_sop !== $sop->nama_sop){
            $rules['nama_sop'] .= '|unique:sop';
        }

        $request->validate($rules,[
            'nama_sop.required' => 'Harap masukan nama SOP',
            'nama_sop.unique' => 'Nama SOP sudah ada',
            'ket_sop.required' => 'Harap masukan keterangan SOP',
            'image_sop.required' => 'Harap masukan foto SOP',
            'image_sop.mimes' => 'File yang anda masukan bukan file jpg,bmp,png,jpeg,svg',
            'image_sop.max' => 'Ukuran file yang anda masukan melebihi 2MB',
        ]);

        $sop->nama_sop = $request->nama_sop;
        $sop->ket_sop = $request->ket_sop;

        if($request->hasFile('image_sop')){
            File::delete(public_path('images/sop/'.$sop->image_sop));
            $imageName = $request->nama_sop. '.'. $request->image_sop->extension();
            $request->image_sop->move(public_path('images/sop/'), $imageName);
            $sop->image_sop = $imageName;
        }

        $sop->save();

        return redirect()->route('sop.index')->with('success', 'Berhasil Update SOP');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sop = Sop::findOrFail($id);
        $path = 'images/sop/';

        File::delete(public_path($path . $sop['image_sop']));
        $sop->delete();

        return redirect()->route('sop.index')->with('success', 'SOP berhasil dihapus');
    }
}
