<?php

namespace App\Http\Livewire;

use App\Models\Kapsam;
use Livewire\Component;

class Soru extends Component
{
    public $soru;
    public $sinavlar;
    public $dersler;
    public $active_sinav;

    protected $listeners = [
        'add' => 'add',
        'update' => 'update',
        'delete' => 'delete',
    ];

    public function mount()
    {
        $this->sinavlar = Kapsam::query()
            ->where('tur', '=', 'sinav')
            ->orWhere('tur', '=', 'sinav')
            ->orderby('title', 'asc')
            ->get();

        $this->dersler = Kapsam::query()
            ->where('tur', '=', 'ders')
            ->orderby('title', 'asc')
            ->get();

        $this->active_sinav = Kapsam::query()
            ->where('tur', '=', 'sinav')
            ->orderby('title', 'asc')
            ->first()->id;
    }

    public function render()
    {
        return view('livewire.soru');
    }

    public function sinavSec($sinav)
    {
        $this->active_sinav = $sinav;
    }
}
