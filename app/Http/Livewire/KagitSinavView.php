<?php

namespace App\Http\Livewire;

use App\Models\KagitSinav;
use App\Models\KapsamDal;
use App\Models\Page;
use App\Models\KagitSoru;
use App\Models\KapsamDers;
use App\Models\KapsamSinav;
use Illuminate\Support\Arr;
use Livewire\Component;

class KagitSinavView extends Component
{
    public $sinav_id = false;
    public $sinav;
    public $sayfalar = [];
    public $active_page_id = false;
    public $active_page;
    public $active_page_data = false;
    public $active_dal_id = false;
    public $sayfaSayisi = false;
    public $isKapsamEdit = false;
    public $is_publishable = false;
    public $publish_errors = [];
    public $soru_durum_dizini;

    protected $listeners = [
        'selectDal' => 'selectDal',
        'soruSayfaRelation' => 'soruSayfaRelation',
        'selectDogru' => 'selectDogru',
        'deletePage' => 'deletePage',
    ];

    public function mount()
    {
        $this->sinav_id = request('id');
        $this->sinav = KagitSinav::find($this->sinav_id);
        $this->getPages();
    }

    public function render()
    {
        return view('livewire.kagit-sinav-view', [
            'sinav' => $this->sinav,
            'kapsam' => KapsamSinav::all(),
        ]);
    }

    public function getPages()
    {
        $this->sayfalar = Page::where('kagit_sinav_id', '=', $this->sinav_id)
            ->orderBy('sira', 'asc')
            ->get();
    }

    public function getActivePage()
    {
        $this->active_page = Page::find($this->active_page_id);

        $this->active_page_data = Page::imgEncode(
            $this->active_page->stored_as
        );

        if ($this->active_page->kapsam_dal_id != null) {
            $this->sayfaSayisi = KapsamDal::find(
                $this->active_page->kapsam_dal_id
            )->ssayisi;

            $this->active_dal_id = $this->active_page->kapsam_dal_id;
        } else {
            $this->active_dal_id = false;
        }
    }

    public function changePage($pageId)
    {
        $this->active_page_id = $pageId;

        $this->getActivePage();
        $this->getPages();
    }

    public function movePageDown($pageId)
    {
        $selPage = Page::find($pageId);

        $nextPage = Page::where('kagit_sinav_id', '=', $this->sinav_id)
            ->where('sira', $selPage->sira + 1)
            ->first();

        $propsSel['sira'] = $selPage->sira + 1;
        $propsNext['sira'] = $nextPage->sira - 1;

        $selPage->update($propsSel);
        $nextPage->update($propsNext);

        $this->active_page_id = $selPage->id;

        $this->getPages();
    }

    public function movePageUp($pageId)
    {
        $selPage = Page::find($pageId);

        $prevPage = Page::where('kagit_sinav_id', '=', $this->sinav_id)
            ->where('sira', $selPage->sira - 1)
            ->first();

        $propsSel['sira'] = $selPage->sira - 1;
        $propsPrev['sira'] = $prevPage->sira + 1;

        $selPage->update($propsSel);
        $prevPage->update($propsPrev);

        $this->active_page_id = $selPage->id;

        $this->getPages();
    }

    public function selectDal($id)
    {
        $props = [
            'kapsam_dal_id' => $id,
        ];

        $this->sayfaSayisi = KapsamDal::find($id)->ssayisi;

        if ($this->active_page->kapsam_dal_id != $id) {
            KagitSoru::where('page_id', $this->active_page_id)->delete();
        }

        Page::find($this->active_page_id)->update($props);

        $this->getActivePage();
    }

    public function soruSayfaRelation($islem, $soruNo)
    {
        if ($islem == 'add') {
            $props = [
                'page_id' => $this->active_page_id,
                'soruno' => $soruNo,
            ];

            KagitSoru::create($props);
        }

        if ($islem == 'remove') {
            KagitSoru::where('page_id', $this->active_page_id)
                ->where('soruno', $soruNo)
                ->delete();
        }

        $this->active_page = Page::find($this->active_page_id);
    }

    public function selectDogru($soruNo, $harf)
    {
        $props = [
            'dogrusecenek' => $harf,
        ];

        KagitSoru::where('page_id', $this->active_page_id)
            ->where('soruno', $soruNo)
            ->update($props);

        $this->active_page = Page::find($this->active_page_id);
    }

    public function deletePage($pageId)
    {
        KagitSoru::where('page_id', '=', $pageId)->delete();

        Page::find($pageId)->delete();

        $this->active_page_id = false;

        $this->active_page = false;

        $this->getPages();
    }

    public function editKapsam()
    {
        $this->isKapsamEdit
            ? ($this->isKapsamEdit = false)
            : ($this->isKapsamEdit = true);
    }

    public function sinavPublish()
    {
        $this->publish_errors = [];

        // Tüm soruların karşılığı var mı?
        $this->soruIsaretlemeDurumu();

        foreach ($this->soru_durum_dizini as $d => $value) {
            if ($value) {
                foreach ($value as $key => $v) {
                    if ($d == 'dallar') {
                        $abbr = KapsamDal::find($key)->abbr;
                    }

                    if ($d == 'dersler') {
                        $abbr = KapsamDers::find($key)->abbr;
                    }

                    $filtered[$abbr] = Arr::where($v, function ($value, $key) {
                        return is_null($value);
                    });

                    if (count($filtered[$abbr]) == 0) {
                        unset($filtered[$abbr]);
                    }
                }
            }
        }

        $this->publish_errors['eksik_sorular'] = $filtered;

        // dd(['a' => $this->soru_durum_dizini, 'b' => $filtered]);

        foreach ($this->sayfalar as $key => $page) {
            if (
                $page->kapsam_dal_id === null &&
                $page->kapsam_ders_id === null
            ) {
                $this->publish_errors[] =
                    $page->sira .
                    ' numaralı sayfanın içeriği ve soruları seçilmemiş';
            }

            $sayfa_sorulari = KagitSoru::where(
                'page_id',
                '=',
                $page->id
            )->get();

            if (count($sayfa_sorulari) < 1) {
                $this->publish_errors[] =
                    'Sayfa ' . $page->sira . ' için HİÇ soru eklenmemiştir';
            }

            // SEÇİLİ SORULARIN DOĞRU ŞIKLARI İŞARETLENMİŞ Mİ?
            foreach ($sayfa_sorulari as $ksoru) {
                if ($ksoru->dogrusecenek === null) {
                    $this->publish_errors[] =
                        'Sayfa ' .
                        $page->sira .
                        ' Soru ' .
                        $ksoru->soruno .
                        '`nın DOĞRU ŞIK işaretlenmemiş';
                }
            }
        }

        if (count($this->publish_errors) == 0) {
            $this->is_publishable = true;
        }

        // dd($this->publish_errors);
    }

    public function soruIsaretlemeDurumu()
    {
        $this->soru_durum_dizini = $this->sinav->soruDizini();

        foreach ($this->sayfalar as $page) {
            $sayfa_sorulari = KagitSoru::where(
                'page_id',
                '=',
                $page->id
            )->get();

            // İŞARETLENMİŞ SORULAR
            foreach ($sayfa_sorulari as $ksoru) {
                if ($page->kapsam_dal_id && $page->tum_sorular === null) {
                    $this->soru_durum_dizini['dallar'][$page->kapsam_dal_id][
                        $ksoru->soruno
                    ] = 'done';
                }

                if ($page->tum_sorular !== null) {
                    $this->soru_durum_dizini['dersler'][$page->kapsam_ders_id][
                        $ksoru->soruno
                    ] = 'done';
                }
            }
        }

        return true;
    }
}
