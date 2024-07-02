<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop;
use Illuminate\Support\Facades\File;


class SopController extends Controller
{
    //Start Admin
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $sops = Sop::all();
            $title = 'SOP Provice Group';
            return view('admin.sop.index',compact('title','sops'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $title = 'Tambah Data SOP Provice Group';
            return view('admin.sop.create',compact('title'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $request->validate([
                'nama_sop' => 'required|unique:sop',
                'tujuan_sop' => 'required',
                'cara_penggunaan_sop' => 'required',
                'perawatan_peralatan_sop' => 'required',
                'keselamatan_kerja_sop' => 'required',
                'image_sop' => 'required|mimes:jpg,bmp,png,jpeg,svg',
            ],[
                'nama_sop.required' => 'Harap masukan nama SOP',
                'nama_sop.unique' => 'Nama SOP sudah ada',
                'tujuan_sop.required' => 'Harap masukan tujuan SOP',
                'cara_penggunaan_sop.required' => 'Harap masukan cara penggunaan SOP',
                'perawatan_peralatan_sop.required' => 'Harap masukan perawatan peralatan',
                'keselamatan_kerja_sop.required' => 'Harap masukan keselamatan kerja',
                'image_sop.required' => 'Harap masukan foto SOP',
                'image_sop.mimes' => 'File yang anda masukan bukan file jpg,bmp,png,jpeg,svg',
                // 'image_sop.max' => 'Ukuran file yang anda masukan melebihi 2MB',
            ]);

            // Inisialisasi $imageName sebagai null
            $imageName = null;

            // Jika image_sop ada dan valid
            if ($request->hasFile('image_sop') && $request->file('image_sop')->isValid()) {
                $imageName = $request->image_sop->getClientOriginalName();
                $request->image_sop->move(public_path('images/sop/'), $imageName);

                // Periksa apakah nama file sudah ada di database
                $q = Sop::where('image_sop', '=', $imageName)->count();
                if ($q > 0) {
                    return redirect()->back()->withErrors(['image_sop' => 'File gambar sudah ada']);
                }
            }

            // Buat entri baru di database
            Sop::create([
                'nama_sop' => $request->nama_sop,
                'tujuan_sop' => $request->tujuan_sop,
                'cara_penggunaan_sop' => $request->cara_penggunaan_sop,
                'perawatan_peralatan_sop' => $request->perawatan_peralatan_sop,
                'keselamatan_kerja_sop' => $request->keselamatan_kerja_sop,
                'image_sop' => $imageName,
            ]);

            return redirect()->route('sop.index')->with('success', 'Berhasil Tambah SOP Pekerjaan');
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            $sop = Sop::findOrFail($id);
            $title = 'Ubah Data SOP Provice Group';
            return view('admin.sop.edit', compact('sop', 'title'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            $sop = Sop::findOrFail($id);

            $rules = [
                'nama_sop' => 'required',
                'tujuan_sop' => 'required',
                'cara_penggunaan_sop' => 'required',
                'perawatan_peralatan_sop' => 'required',
                'keselamatan_kerja_sop' => 'required',
                'image_sop' => $request->hasFile('image_sop') ? 'required|mimes:jpg,bmp,png,jpeg,svg' : '',
            ];

            if($request->nama_sop !== $sop->nama_sop){
                $rules['nama_sop'] .= '|unique:sop';
            }

            $request->validate($rules,[
                'nama_sop.required' => 'Harap masukan nama SOP',
                'nama_sop.unique' => 'Nama SOP sudah ada',
                'tujuan_sop.required' => 'Harap masukan tujuan SOP',
                'cara_penggunaan_sop.required' => 'Harap masukan cara penggunaan SOP',
                'perawatan_peralatan_sop.required' => 'Harap masukan perawatan peralatan',
                'keselamatan_kerja_sop.required' => 'Harap masukan keselamatan kerja',
                'image_sop.required' => 'Harap masukan foto SOP',
                'image_sop.mimes' => 'File yang anda masukan bukan file jpg,bmp,png,jpeg,svg',
            ]);

            $sop->nama_sop = $request->nama_sop;
            $sop->tujuan_sop = $request->tujuan_sop;
            $sop->cara_penggunaan_sop = $request->cara_penggunaan_sop;
            $sop->perawatan_peralatan_sop = $request->perawatan_peralatan_sop;
            $sop->keselamatan_kerja_sop = $request->keselamatan_kerja_sop;

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
    //End Admin

    //Start Cleaner
        public function showSopCleaner(){
            $sops = Sop::all();
            $title = 'Daftar SOP Provice Group';
            return view('cleaner.sop.index',compact('title','sops'));
        }
    //End Cleaner
}
