<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing the user's account.
     */
    public function index()
    {
        $users = User::all();
        $title = 'Pengguna Provice Group';
        return view('profile.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new user account.
     */
    public function create()
    {
        $title = 'Tambah Data Pengguna Provice Group';
        return view('profile.create',compact('title'));
    }

    /**
     * Store a newly created user account in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'jk' => $request->filled('jk') ? $request->jk : null,
            'no_telepon' => $request->filled('no_telepon') ? $request->no_telepon : null,
            'level' => $request->filled('level') ? $request->level : 'cleaner',
            'image'=>null,
        ]);

        return redirect()->route('user.index')->with('success', 'Berhasil Tambah Akun Pengguna');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = User::find($request->id_users);
        $title = 'Ubah Data Pengguna Provice Group';
        return view('profile.edit', compact('user', 'title'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = User::find($request->id_users);
        $rules = [
            'name' => 'required',
            'email' => 'required|email',

        ];

        if($request->email !== $user->email){
            $rules['email'] .= '|unique:users';
        }

        $request->validate($rules,[
            'nama.required' => 'Harap Masukan Nama Pengguna',
            'email.required' => 'Harap Masukan Email Pengguna',
            'email.email' => 'Format Email tidak valid',
            'email.unique' => 'Email Yang Anda Masukan Sudah Digunakan',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jk' => $request->filled('jk')? $request->jk : null,
            'no_telepon' => $request->filled('no_telepon')? $request->no_telepon : null,
            'level' => $request->filled('level')? $request->level : 'cleaner',
        ]);

        return redirect()->route('user.index')->with('success', 'Berhasil Ubah Akun Pengguna');
    }

    /**
     * Delete the user's account.
     */
    function destroy(Request $request)
    {
        $user = User::find($request->id_users);
        if ($user) {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus');
        } else {
            return redirect()->route('user.index')->with('error', 'Pengguna tidak ditemukan');
        }
    }
}
