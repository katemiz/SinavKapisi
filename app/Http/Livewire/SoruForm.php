<?php

namespace App\Http\Livewire;

use App\Models\Kapsam;
use App\Models\Soru;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SoruForm extends Component
{
    public $soru = false;
    public $sinavlar;
    public $dersler;

    public $selected_sinav = false;
    public $selected_ders = false;

    public $soru_ici = '<p>Aşağıdaki cümlelerin hangisinde yazım yanlışı <strong><u>yoktur</u></strong>?</p>';
    public $soru_onu = '<p>Aşağıdaki cümlelerin hangisinde yazım yanlışı <strong><u>yoktur</u></strong>?</p>';

    public $gui_action = 'form';

    public $harfler = [
        '0' => 'A',
        '1' => 'B',
        '2' => 'C',
        '3' => 'D',
        '4' => 'E',
        '5' => 'F',
        '6' => 'G',
    ];

    protected $listeners = [
        'edit' => 'edit',
        'insert' => 'insert',
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

        if (request('id') > 0) {
            $this->soru = Soru::find(request('id'));

            $this->selected_ders = Kapsam::find($this->soru->kapsam_id);
            $this->selected_sinav = Kapsam::find(
                $this->selected_ders->parent_id
            );
        }

        if (request('action')) {
            $this->gui_action = request('action');
        }
    }

    public function edit($qid)
    {
        $this->soru = Soru::find($qid);

        $this->gui_action = 'form';
    }

    public function insert($p)
    {
        $props['user_id'] = Auth::id();
        $props['kapsam_id'] = $p['kapsam_id'];
        $props['soru_background'] = $p['soru_background'];
        $props['soru'] = $p['soru'];

        $this->soru = Soru::create($props);

        $this->gui_action = 'view';
    }

    public function update($p)
    {
        $props['user_id'] = Auth::id();
        $props['kapsam_id'] = $p['kapsam_id'];
        $props['soru_background'] = $p['soru_background'];
        $props['soru'] = $p['soru'];

        Soru::find($p['qid'])->update($props);
        $this->soru = Soru::find($p['qid']);

        $this->gui_action = 'view';
    }

    public function render()
    {
        return view('livewire.soru', [
            'soru' => $this->soru,
        ]);
    }
}
