<?php

namespace App\Http\Controllers;

use App\Models\LaporanGrooming;
use App\Models\LaporanPJKP;
use App\Models\TanggapanGrooming;
use App\Models\TanggapanPJKP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Livewire\before;

class DashboardController extends Controller
{
    public function index()
    {
        //Inisialisasi Waktu
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $todayDate = now()->toDateString();
        $user = Auth::user();

        // Data admin
        $dataAdmin = [
            'monthYearNow' => now()->format('F Y'),
            'totalSelesaiGrooming' => TanggapanGrooming::whereBetween('tgl_tg', [$startOfMonth, $endOfMonth])
                ->whereHas('laporanGrooming', function ($query) {
                    $query->where('status_lg', '=', 'hasil');
                })->count(),
            'totalSelesaiPjkp' => TanggapanPJKP::whereBetween('tgl_tp', [$startOfMonth, $endOfMonth])
                ->whereHas('laporanPjkp', function ($query){
                    $query->where('status_lp', '=', 'hasil');
                })->count(),
            'totalAkunCleaner' => User::where('level', 'cleaner')->count(),
        ];

        $SpvFilter = function ($query) use ($user) {
            $query->where('supervisor_id', $user->id_users);
        };
        // Data Supervisor
        $dataSpv = [
            'monthYearNow' => now()->format('F Y'),
            'totalAkunCleaner' => User::where('level', 'cleaner')->where('supervisor_id', $user->id_users)->count(),
            'laporanPjkpBelumDitanggapi' => LaporanPjkp::whereHas('user', $SpvFilter)->whereDate('tgl_lp', $todayDate)->whereDoesntHave('tanggapanPjkps')->count(),
            'laporanGroomingBelumDitanggapi' => LaporanGrooming::whereHas('user', $SpvFilter)->whereDate('tgl_lg', $todayDate)->whereDoesntHave('tanggapanGroomings')->count(),
            'laporanGroomingSebelum' => LaporanGrooming::whereHas('user', $SpvFilter)->whereDate('tgl_lg', $todayDate)->where('status_lg', 'sebelum')->count(),
            'laporanGroomingProses' => LaporanGrooming::whereHas('user', $SpvFilter)->whereDate('tgl_lg', $todayDate)->where('status_lg', 'proses')->count(),
            'laporanGroomingHasil' => LaporanGrooming::whereHas('user', $SpvFilter)->whereDate('tgl_lg', $todayDate)->where('status_lg', 'hasil')->count(),
            'laporanPjkpSebelum' => LaporanPjkp::whereHas('user', $SpvFilter)->whereDate('tgl_lp', $todayDate)->where('status_lp', 'sebelum')->count(),
            'laporanPjkpProses' => LaporanPjkp::whereHas('user', $SpvFilter)->whereDate('tgl_lp', $todayDate)->where('status_lp', 'proses')->count(),
            'laporanPjkpHasil' => LaporanPjkp::whereHas('user', $SpvFilter)->whereDate('tgl_lp', $todayDate)->where('status_lp', 'hasil')->count(),
        ];

        // Data Cleaner
        $dataCleaner = [
            'laporanGroomingDitanggapiSpv' => LaporanGrooming::where('user_id', $user->id_users)->whereDate('tgl_lg', $todayDate)->whereDoesntHave('tanggapanGroomings')->count(),
            'laporanPjkpDitanggapiSpv' => LaporanPJKP::where('user_id', $user->id_users)->whereDate('tgl_lp', $todayDate)->whereDoesntHave('tanggapanPjkps')->count(),
        ];

        $title = 'Dashboard Sistem Monitoring Cleaning Service';
        return view('dashboard', compact('title', 'dataAdmin', 'dataSpv', 'dataCleaner'));
    }

    public function defaultPass(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'jk' => 'required',
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ],[
            'jk.required' => 'Harap masukan jenis kelamin anda',
            'current_password.required' => 'Harap masukan password saat ini',
            'new_password.required' => 'Harap masukan password',
            'new_password.min' => 'Harap masukan password minimal 8 karakter',
            'new_password.different' => 'Harap masukan password yang berbeda dari password saat ini',
            'confirm_password.same' => 'Password yang anda masukan tidak sama',
        ]);
        if (Hash::check($request->current_password, $user->password)){
            $user->update([
                'jk'=>$request->jk,
                'password' =>Hash::make($request->new_password),
                'default_pass'=>1,
            ]);
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error', 'Password anda saat ini tidak sesuai');
        }
    }

}
