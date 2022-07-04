<?php

namespace App\Http\Controllers;

use App\Models\Soru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SoruController extends Controller
{
    public function view(Request $req)
    {
        $soru = Soru::find($req->id);

        return view('livewire.soru-view', [
            'notification' => [
                'type' => 'is-success',
                'message' => 'Soru eklenmiştir',
            ],
            'soru' => $soru,
        ]);
    }

    public function insert(Request $req)
    {
        $props['user_id'] = Auth::id();
        $props['kapsam_id'] = $req->input('selected_ders');
        $props['soru'] = $req->input('editor_data');
        $props['soru_background'] = $req->input('editor_data2');

        $soru = Soru::create($props);

        return view('livewire.soru-view', [
            'notification' => [
                'type' => 'is-success',
                'message' => 'Soru eklenmiştir',
            ],
            'soru' => $soru,
        ]);
    }
}
