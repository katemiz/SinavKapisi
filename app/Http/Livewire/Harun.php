<?php

namespace App\Http\Livewire;

use App\Models\HarunSonuc;
use Livewire\Component;

class Harun extends Component
{
    public $chart = [
        'chart' => [
            'labels' => [],
        ],
        'datasets' => [
            [
                'name' => 'TYT',
                'values' => [],
            ],

            [
                'name' => 'Türkçe',
                'values' => [],
            ],

            [
                'name' => 'Sosyal',
                'values' => [],
            ],

            [
                'name' => 'Matematik',
                'values' => [],
            ],

            [
                'name' => 'Fen',
                'values' => [],
            ],
        ],
    ];

    public function mount()
    {
        $data = HarunSonuc::all();

        foreach ($data as $degerler) {
            array_push(
                $this->chart['chart']['labels'],
                $degerler->sinav_tarihi
            );

            $tur_net = $degerler->tur_dogru - $degerler->tur_yanlis / 4;
            $sos_net = $degerler->sos_dogru - $degerler->sos_yanlis / 4;
            $mat_net = $degerler->mat_dogru - $degerler->mat_yanlis / 4;
            $fen_net = $degerler->fen_dogru - $degerler->fen_yanlis / 4;
            $tyt_net = $tur_net + $sos_net + $mat_net + $fen_net;

            array_push($this->chart['datasets']['0']['values'], $tyt_net);
            array_push($this->chart['datasets']['1']['values'], $tur_net);
            array_push($this->chart['datasets']['2']['values'], $sos_net);
            array_push($this->chart['datasets']['3']['values'], $mat_net);
            array_push($this->chart['datasets']['4']['values'], $fen_net);

            // if (file_put_contents(asset('/js/chartisan.json'), $this->chart)) {
            //     echo 'JSON file created successfully...';
            // } else {
            //     echo 'Oops! Error creating json file...';
            // }
        }

        $this->chart = json_encode($this->chart);
    }

    public function render()
    {
        //dd($this->chart);
        return view('livewire.harun', [
            'chart' => $this->chart,
        ]);

        // return response()->json($this->chart);
    }
}
