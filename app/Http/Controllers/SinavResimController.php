<?php

namespace App\Http\Controllers;

use App\Models\Kapsam;
use App\Models\Page;
use App\Models\SinavResim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SinavResimController extends Controller
{
    public function form(Request $req)
    {
        $a = Kapsam::with('children')
            ->where('parent_id', '=', '0')
            ->orderBy('title', 'asc')
            ->get();

        return view('sinav-ekle-resim', [
            'kapsam' => $a,
        ]);
    }

    public function storefiles(Request $req)
    {
        $sinavresim['user_id'] = Auth::id();
        $sinavresim['kapsam_id'] = $req->input('sinavturu');

        $new_sinav = SinavResim::create($sinavresim);

        $this->addFiles($req, $new_sinav->id);

        return redirect()->route('sinavresimview', ['id' => $new_sinav->id]);
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
