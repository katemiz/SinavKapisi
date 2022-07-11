<?php

namespace App\Http\Controllers;

use App\Models\Kapsam;
use App\Models\Secenek;
use App\Models\Soru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SoruController extends Controller
{
    public $secenek = false;
    public $add_form = false;

    public function add()
    {
        $sinavlar = Kapsam::query()
            ->where('tur', '=', 'sinav')
            ->orWhere('tur', '=', 'sinav')
            ->orderby('title', 'asc')
            ->get();

        $dersler = Kapsam::query()
            ->where('tur', '=', 'ders')
            ->orderby('title', 'asc')
            ->get();

        if (request('id') > 0) {
            $this->soru = Soru::find(request('id'));

            // $this->selected_ders = Kapsam::find($this->soru->kapsam_id);
            // $this->selected_sinav = Kapsam::find(
            //     $this->selected_ders->parent_id
            // );

            return view('soru-edit', [
                'soru' => $this->soru,
                'sinavlar' => $sinavlar,
                'dersler' => $dersler,
            ]);
        }

        return view('soru-add', [
            'sinavlar' => $sinavlar,
            'dersler' => $dersler,
        ]);
    }

    public function view(Request $req)
    {
        $soru = Soru::find(request('id'));

        if (
            request('secId') !== null &&
            is_numeric(request('secId')) &&
            request('secId') > 0
        ) {
            $this->secenekId = request('secId');
            $this->add_form = true;
        }

        return view('livewire.soru-view', [
            'notification' => [
                'type' => 'is-success',
                'message' => 'Soru eklenmiştir',
            ],
            'soru' => $soru,
            'harfler' => Config::get('constants.harfler'),
            'secenek' => $this->secenek,
            'add_form' => $this->add_form,
        ]);
    }

    public function secenekForm(Request $req)
    {
        $soru = Soru::find(request('id'));

        if (
            request('secId') !== null &&
            is_numeric(request('secId')) &&
            request('secId') > 0
        ) {
            $this->secenek = Secenek::find(request('secId'));
        } else {
            $this->add_form = true;
        }

        //dd($this->show_form);

        return view('livewire.soru-view', [
            'notification' => [
                'type' => 'is-success',
                'message' => 'Soru eklenmiştir',
            ],
            'soru' => $soru,
            'harfler' => Config::get('constants.harfler'),
            'secenek' => $this->secenek,
            'add_form' => $this->add_form,
        ]);
    }

    public function insert(Request $req)
    {
        $props['user_id'] = Auth::id();
        $props['kapsam_id'] = $req->input('sders');
        $props['soru'] = $req->input('editor_data1');
        $props['soru_background'] = $req->input('editor_data2');

        $soru = Soru::create($props);

        return redirect()->route('soruview', ['id' => $soru->id]);
    }

    public function update(Request $req)
    {
        $props['user_id'] = Auth::id();
        $props['kapsam_id'] = $req->input('sders');
        $props['soru'] = $req->input('editor_data1');
        $props['soru_background'] = $req->input('editor_data2');

        Soru::find(request('id'))->update($props);

        return redirect()->route('soruview', ['id' => request('id')]);
    }

    public function insertSecenek(Request $req)
    {
        $props['user_id'] = Auth::id();
        $props['soru_id'] = request('id');
        $props['icerik'] = $req->input('editor_data');
        $props['dogru_mu'] = $req->input('dogru_mu');

        Secenek::create($props);

        return redirect()->route('soruview', ['id' => request('id')]);
    }

    public function updateSecenek(Request $req)
    {
        $props['user_id'] = Auth::id();
        $props['soru_id'] = request('id');
        $props['icerik'] = $req->input('editor_data');
        $props['dogru_mu'] = $req->input('dogru_mu');

        Secenek::find(request('secId'))->update($props);

        return redirect()->route('soruview', ['id' => request('id')]);
    }

    public function deleteSecenek(Request $req)
    {
        Secenek::find(request('secId'))->delete();

        return redirect()->route('soruview', ['id' => request('id')]);
    }
}
