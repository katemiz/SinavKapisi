<?php

namespace App\Http\Livewire;

use App\Models\Soru;
use Livewire\Component;

class Eexam extends Component
{
    public $exm = false;
    public $cur_que_id = 3;
    public $cur_que_props = false;
    public $cur_sel_option = false;

    public function mount()
    {
        if (request('eid')) {
        }
    }

    public function getQueProps()
    {
        $this->cur_que_props = Soru::find($this->cur_que_id);
    }

    public function render()
    {
        $this->getQueProps();

        return view('livewire.eexam', [
            'qprops' => $this->cur_que_props,
        ]);
    }

    public function selectOpt($id_selected)
    {
        $this->cur_sel_option = $id_selected;
    }
}
