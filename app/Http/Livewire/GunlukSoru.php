<?php

namespace App\Http\Livewire;

use App\Models\Secenek;
use App\Models\Soru;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

class GunlukSoru extends Component
{
    public $soru;
    public $secili_cevap = false;
    public $is_there_response = false;
    public $is_response_correct = false;

    public function mount()
    {
        switch (request('tur')) {
            case 'M':
                $dizin = [3, 4];
                break;

            case 'F':
                $dizin = [5, 6];
                break;

            case 'T':
                $dizin = [7];
                break;
        }

        $this->soru = Soru::orderBy('updated_at', 'desc')
            ->whereIn('kapsam_id', $dizin)
            ->first();
    }

    public function cevapSec($secId)
    {
        $this->is_there_response = false;
        $this->is_response_correct = false;

        $this->secili_cevap = $secId;
    }

    public function checkCevap($secId)
    {
        $this->is_there_response = true;
        $secili = Secenek::find($secId);

        if ($secili->dogru_mu) {
            $this->is_response_correct = true;
        }
    }

    public function render()
    {
        return view('livewire.gunluk-soru', [
            'soru' => $this->soru,
            'harfler' => Config::get('constants.harfler'),
        ]);
    }
}
