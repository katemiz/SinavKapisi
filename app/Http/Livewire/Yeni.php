<?php

namespace App\Http\Livewire;

use App\Models\Kapsam;
use App\Models\Secenek;
use App\Models\Soru;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Yeni extends Component
{
    public $qid = 0;
    public $soru = false;

    public $actiontype;

    public $sinavlar;
    public $dersler;

    public $harfler = [
        '0' => 'A',
        '1' => 'B',
        '2' => 'C',
        '3' => 'D',
        '4' => 'E',
        '5' => 'F',
        '6' => 'G',
    ];

    public $selected_sinav = false;
    public $selected_ders = false;

    public $placeholders = [
        'soru_onu' =>
            '<p>Aşağıdaki cümlelerin hangisinde yazım yanlışı <strong><u>yoktur</u></strong>?</p>',
        'soru_ici' =>
            '<p>Aşağıdaki cümlelerin hangisinde yazım yanlışı <strong><u>yoktur</u></strong>?</p>',
    ];

    protected $listeners = [
        'insert' => 'insert',
        'update' => 'update',
        'soru_edit' => 'editSoru',
        'secenek_insert' => 'insertSecenek',
        'secenek_update' => 'updateSecenek',
        'secenek_delete' => 'deleteSecenek',
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
            $this->actiontype = request('action');
        }
    }

    public function insert($p)
    {
        $props['user_id'] = Auth::id();
        $props['kapsam_id'] = $p['kapsam_id'];
        $props['soru_background'] = $p['soru_background'];
        $props['soru'] = $p['soru'];

        $this->soru = Soru::create($props);

        $this->actiontype = 'view';
    }

    public function update()
    {
        $this->actiontype = 'view';
    }

    public function insertSecenek($p)
    {
        $props['user_id'] = Auth::id();
        $props['soru_id'] = $p['qid'];
        $props['icerik'] = $p['icerik'];
        $props['dogru_mu'] = $p['dogru_mu'];

        Secenek::create($props);
        $this->soru = Soru::find($p['qid']);

        $this->actiontype = 'view';
    }

    public function deleteSecenek($qid, $id)
    {
        Secenek::find($id)->delete();
        $this->soru = Soru::find($qid);
        $this->actiontype = 'view';
    }

    public function editSoru($id)
    {
        $this->soru = Soru::find($id);
        $this->actiontype = 'form';
    }

    public function render()
    {
        return view('livewire.yeni');
    }
}
