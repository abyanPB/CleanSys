<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LaporanGrooming;

class GroomingLivewire extends Component
{

    public $laporanHariIni;

    protected $listeners = ['refreshData'];

    public function mount()
    {
        $this->refreshData(); // Panggil method refresh data ketika komponen dimuat pertama kali

    }

    public function render()
    {
        $this->laporanHariIni = LaporanGrooming::whereDate('tgl_lg', today())->get();
        return view('livewire.grooming-livewire', ['laporanHariIni' => $this->laporanHariIni]);
    }


    public function refreshData()
    {
        $this->laporanHariIni = LaporanGrooming::whereDate('tgl_lg', today())->get();
    }

}
