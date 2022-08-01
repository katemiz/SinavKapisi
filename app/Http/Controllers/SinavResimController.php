<?php

namespace App\Http\Controllers;

use App\Models\KapsamSinav;
use App\Models\Page;
use App\Models\SinavResim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SinavResimController extends Controller
{
    public function form(Request $req)
    {
        $sinav = false;
        $a = KapsamSinav::all();

        if (!blank(request('id'))) {
            $sinav = SinavResim::find(request('id'));
        }

        return view('sinav-ekle-resim', [
            'kapsam' => $a,
            'sinav' => $sinav,
        ]);
    }

    public function storefiles(Request $req)
    {
        if (blank(request('id'))) {
            $sinavresim['user_id'] = Auth::id();

            $sinav_dal_ders_arr = explode(':', $req->input('sinavturu'));

            $sinavresim['kapsam_sinav_id'] = $sinav_dal_ders_arr['0'];

            if (count($sinav_dal_ders_arr) == 1) {
                $sinavresim['kapsam_dal_id'] = null;
            } else {
                $sinavresim['kapsam_dal_id'] = $sinav_dal_ders_arr['1'];
            }

            if (count($sinav_dal_ders_arr) == 3) {
                $sinavresim['kapsam_ders_id'] = $sinav_dal_ders_arr['2'];
            } else {
                $sinavresim['kapsam_ders_id'] = null;
            }

            $new_sinav = SinavResim::create($sinavresim);

            $this->addFiles($req, $new_sinav->id);
            return redirect()->route('sinavresimview', [
                'id' => $new_sinav->id,
            ]);
        } else {
            $this->addFiles($req, request('id'));
            return redirect()->route('sinavresimview', ['id' => request('id')]);
        }
    }

    public function addFiles($req, $id)
    {
        if ($req->has('assets')) {
            $sira = 1;

            foreach ($req->file('assets') as $dosya) {
                if (strlen($dosya->getMimeType()) > 32) {
                    $filename = '/RESIM/SINAV' . $id . '/file/other';
                } else {
                    $filename =
                        '/RESIM/SINAV' . $id . '/' . $dosya->getMimeType();
                }

                $saved_dir = Storage::disk('local')->put($filename, $dosya);

                $this->saveRecord($dosya, $id, $saved_dir, $sira++);
            }
        }
    }

    public function saveRecord($dosya, $id, $saved_dir, $sira)
    {
        $dosya_data = [
            'sinav_resim_id' => $id,
            'user_id' => Auth::id(),
            'sira' => $sira,
            'filename' => $dosya->getClientOriginalName(),
            'size' => $dosya->getSize(),
            'stored_as' => $saved_dir,
            'mimetype' => $dosya->getMimeType(),
        ];

        Page::create($dosya_data);
    }
}
