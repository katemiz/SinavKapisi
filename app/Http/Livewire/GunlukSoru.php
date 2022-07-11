<?php

namespace App\Http\Livewire;

use App\Models\Soru;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

class GunlukSoru extends Component
{
    public $soru;

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

    public function render()
    {
        // dd($this->soru);

        return view('livewire.gunluk-soru', [
            'soru' => $this->soru,
            'harfler' => Config::get('constants.harfler'),
        ]);
    }
}
