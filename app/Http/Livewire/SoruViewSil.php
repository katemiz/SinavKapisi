<?php

namespace App\Http\Livewire;

use App\Models\Secenek;
use App\Models\Soru;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SoruView extends Component
{
    public $qid;
    public $soru;

    public $show_form = false;

    public $harfler = [
        '0' => 'A',
        '1' => 'B',
        '2' => 'C',
        '3' => 'D',
        '4' => 'E',
        '5' => 'F',
        '6' => 'G',
        '7' => 'H',
        '8' => 'K',
        '9' => 'M',
    ];

    protected $listeners = [
        'insert' => 'insert',
        'update' => 'update',
        'delete' => 'delete',
        'showForm' => 'showForm',
    ];

    public function mount()
    {
        $this->qid = request('id');
        $this->soru = Soru::find($this->qid);
    }

    public function insert($p)
    {
        $props['user_id'] = Auth::id();
        $props['soru_id'] = $p['qid'];
        $props['icerik'] = $p['icerik'];
        $props['dogru_mu'] = $p['dogru_mu'];

        Secenek::create($props);
        $this->soru = Soru::find($this->qid);
    }

    public function delete($id)
    {
        Secenek::find($id)->delete();
        $this->soru = Soru::find($this->qid);
    }

    public function showForm()
    {
        $this->show_form = true;
    }

    public function render()
    {
        $this->zeroize_editor = 1;
        return view('livewire.soru-view', [
            'soru' => $this->soru,
        ]);
    }
}
