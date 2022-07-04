<?php

namespace App\Http\Livewire;

use App\Models\Kapsam;
use Livewire\Component;

class SoruForm extends Component
{
    public $soru;
    public $sinavlar;
    public $dersler;

    public $soru_ici = '<p>Aşağıdaki cümlelerin hangisinde yazım yanlışı <strong><u>yoktur</u></strong>?</p>';
    public $soru_onu = '<p>Aşağıdaki cümlelerin hangisinde yazım yanlışı <strong><u>yoktur</u></strong>?</p>';

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
    }

    public function render()
    {
        return view('livewire.soru');
    }
}
