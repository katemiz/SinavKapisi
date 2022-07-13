<?php

namespace App\Http\Controllers;

use App\Models\Kapsam;
use Illuminate\Http\Request;

class SinavEkleResimController extends Controller
{
    public function form(Request $req)
    {
        $k = new Kapsam();

        $kapsam = $k->getSinavlarDersler();

        $a = Kapsam::with('children')
            ->where('parent_id', '=', '0')
            ->orderBy('title', 'asc')
            ->get();

        // dd($a);

        return view('sinav-ekle-resim', [
            'kapsam' => $a,
        ]);
    }
}
