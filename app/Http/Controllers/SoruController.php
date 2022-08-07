<?php

namespace App\Http\Controllers;

use App\Models\CevapSecenek;
use App\Models\KapsamSinav;
use App\Models\Soru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SoruController extends Controller
{
    public $secenek = false;
    public $add_form = false;
    public $publish_errors = false;

    public function form()
    {
        $kapsam = KapsamSinav::all();

        if (request('id') > 0) {
            $this->soru = Soru::find(request('id'));

            return view('soru-edit', [
                'soru' => $this->soru,
                'kapsam' => $kapsam,
                'publish_errors' => $this->publish_errors,
            ]);
        }

        return view('soru-add', [
            'kapsam' => $kapsam,
            'publish_errors' => $this->publish_errors,
        ]);
    }

    public function view()
    {
        if (blank(request('id'))) {
            abort('403');
        }

        $soru = Soru::find(request('id'));

        if (!blank(request('secId'))) {
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
            'publish_errors' => $this->publish_errors,
        ]);
    }

    public function secenekForm(Request $req)
    {
        $soru = Soru::find(request('id'));

        if (!blank(request('secId'))) {
            $this->secenek = CevapSecenek::find(request('secId'));
        } else {
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
            'publish_errors' => $this->publish_errors,
        ]);
    }

    public function readKapsamInput($req)
    {
        $sinav_dal_ders_arr = explode(':', $req->input('kapsamturu'));

        $props['kapsam_sinav_id'] = $sinav_dal_ders_arr['0'];

        if (count($sinav_dal_ders_arr) == 1) {
            $props['kapsam_dal_id'] = null;
        } else {
            $props['kapsam_dal_id'] = $sinav_dal_ders_arr['1'];
        }

        if (count($sinav_dal_ders_arr) == 3) {
            $props['kapsam_ders_id'] = $sinav_dal_ders_arr['2'];
        } else {
            $props['kapsam_ders_id'] = null;
        }

        return $props;
    }

    public function insert(Request $req)
    {
        $props = $this->readKapsamInput($req);

        $props['user_id'] = Auth::id();
        $props['soru_background'] = $req->input('editor_data1');
        $props['soru'] = $req->input('editor_data2');

        $soru = Soru::create($props);

        return redirect()->route('soruview', ['id' => $soru->id]);
    }

    public function update(Request $req)
    {
        $props = $this->readKapsamInput($req);

        $props['user_id'] = Auth::id();
        $props['soru_background'] = $req->input('editor_data1');
        $props['soru'] = $req->input('editor_data2');

        Soru::find(request('id'))->update($props);

        return redirect()->route('soruview', ['id' => request('id')]);
    }

    public function insertSecenek(Request $req)
    {
        $props['user_id'] = Auth::id();
        $props['soru_id'] = request('id');
        $props['icerik'] = $req->input('editor_data');
        $props['dogru_mu'] = $req->input('dogru_mu');

        CevapSecenek::create($props);

        return redirect()->route('soruview', ['id' => request('id')]);
    }

    public function updateSecenek(Request $req)
    {
        $props['user_id'] = Auth::id();
        $props['soru_id'] = request('id');
        $props['icerik'] = $req->input('editor_data');
        $props['dogru_mu'] = $req->input('dogru_mu');

        CevapSecenek::find(request('secId'))->update($props);
        return redirect()->route('soruview', ['id' => request('id')]);
    }

    public function deleteSecenek()
    {
        CevapSecenek::find(request('secId'))->delete();
        return redirect()->route('soruview', ['id' => request('id')]);
    }

    public function publish()
    {
        $soru = Soru::find(request('id'));

        if ($soru->cevapSayisi != Config::get('constants.cevap_sik_sayisi')) {
            $this->publish_errors[] =
                'Soru için gereken cevap şıkları sayısı ' .
                Config::get('constants.cevap_sik_sayisi') .
                ' olmalı';
        }

        if ($soru->dogruCevapSayisi != 1) {
            $this->publish_errors[] =
                'Cevap şıklarından bir tanesi DOĞRU olarak işaretlenmeli';
        }

        if ($this->publish_errors) {
            return view('livewire.soru-view', [
                'soru' => $soru,
                'harfler' => Config::get('constants.harfler'),
                'secenek' => $this->secenek,
                'add_form' => $this->add_form,
                'publish_errors' => $this->publish_errors,
            ]);
        }

        $soru->update(['is_published' => true]);

        return redirect()->back();
    }
}
