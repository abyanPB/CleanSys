<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\LaporanPJKP;
use App\Models\Sop;
use App\Models\TanggapanPJKP;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class PjkpLivewire extends Component
{

    public function render()
    {
        $areas = Area::all();
        $sops = Sop::all();
        $laporan_pjkp = LaporanPJKP::all();

        return view('livewire.pjkp-livewire', [
            'laporan_pjkp' => $laporan_pjkp,
            'areas' => $areas,
            'sops' => $sops
        ])->extends('layouts.master');
    }
}
