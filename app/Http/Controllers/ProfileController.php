<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing the user's account.
     */
    public function index()
    {
        $users = User::all();
        $title = 'Pengguna Provice Group';
        return view('admin.profile.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new user account.
     */
    public function create()
    {
        $title = 'Tambah Data Pengguna Provice Group';
        return view('admin.profile.create',compact('title'));
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
            'default_pass'=>0,
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
        return view('admin.profile.edit', compact('user', 'title'));
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
            'name.required' => 'Harap Masukan Nama Pengguna',
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
    public function destroy(Request $request)
    {
        $user = User::find($request->id_users);
        if ($user) {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus');
        } else {
            return redirect()->route('user.index')->with('error', 'Pengguna tidak ditemukan');
        }
    }

    /**
     * Display the user's profile form.
     */
    public function viewProfile()
    {
        $user = Auth::user();
        $title = 'Profil Pengguna';
        return view('viewProfile', compact('user', 'title'));
    }
    /**
     * Update the user's profile information.
     */
    public function changeProfile(Request $request){
        $user = Auth::user();
        $validation = $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];

        if($request->email !== $user->email){
            $rules['email'] .= '|unique:users';
        }

        $pass1 = Str::of($request->current_password)->isEmpty();
        $pass2 = Str::of($request->new_password)->isEmpty();
        $pass3 = Str::of($request->confirm_password)->isEmpty();

        if ($pass1 && $pass2 && $pass3) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        else {
            $request->validate([
                'password' => 'required',
                'password_confirm' => 'required|same:password',
            ]);

            $user->update([
                'name' => e($request->name),
                'email' => Str::of(e($request->email))->lower(),
                'password' => Hash::make($request->password)
            ]);
        }

        if ($request->file('image')) {
            $this->userChangeProfileImage($request, $user->id, $request->file('image'));
        }
        return redirect()->route('showProfile')->with('success', 'Berhasil Ubah Profile');
    }


    private function userChangeProfileImage($request, $idUser, $image){
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|max:1024'
        ]);
        $oldImage = Auth::guard('web')->user()->image;

        $newImageName = 'image_profile' . '_' . time() . '.' . $image->extension();

        $path = 'asset-image/profil/';

        if ($oldImage) {
            if (File::exists(public_path($path . $oldImage))) {
                File::delete(public_path($path . $oldImage));
            }
        }
        $request->image->move(public_path($path), $newImageName);
        User::where('id_users', $idUser)
            ->update(['image' => $newImageName]);
    }
}
