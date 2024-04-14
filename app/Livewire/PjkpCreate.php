<?php

namespace App\Livewire;
use App\Models\Area;
use App\Models\Sop;
use App\Models\LaporanPJKP;
use App\Models\TanggapanPJKP;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class PjkpCreate extends Component
{
    public $id_users;
    public $id_area;
    public $id_sop;
    public $id_tanggapan_pjkp;
    public $status_lp;

    public function store()
    {
        $validator = Validator::make([
            'id_area' => $this->id_area,
            'id_sop' => $this->id_sop,
            'status_lp' => $this->status_lp,
        ], [
            'id_area' => 'required',
            'id_sop' => 'required',
            'status_lp' => 'required',
        ], [
            'id_area.required' => 'Area kerja tidak boleh kosong',
            'id_sop.required' => 'SOP kerja tidak boleh kosong',
            'status_lp.required' => 'Status pekerjaan tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $this->emit('showErrorMessage', $validator->messages()->all());
            return;
        }

        $currentDateTime = Carbon::now();

        LaporanPJKP::create([
            'id_users' => Auth::user()->id_users,
            'id_area' => $this->id_area,
            'id_sop' => $this->id_sop,
            'tgl_lp' => $currentDateTime,
            'image_lp' => null,
            'status_lp' => $this->status_lp,
        ]);

        $this->redirect(PjkpLivewire::class);
    }

    public function render()
    {
        $areas = Area::all();
        $sops = Sop::all();
        return view('livewire.pjkp-create',['areas'=> $areas, 'sops' => $sops])->extends('layouts.master');
    }
}
