<?php

namespace App\Http\Livewire;

use App\Models\KagitSinav;
use App\Models\KapsamDal;
use App\Models\Page;
use App\Models\KagitSoru;
use App\Models\KapsamSinav;
use App\Models\SinavResim;
use Livewire\Component;

class KagitSinavView extends Component
{
    public $sinav_id = false;
    public $sinav = false;
    public $sayfalar = false;
    public $active_page_id = false;
    public $active_page = false;
    public $active_page_data = false;
    public $sayfaSayisi = false;
    public $isKapsamEdit = false;

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

        $nextPage = Page::where('sinav_resim_id', '=', $this->sinav_id)
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

        $prevPage = Page::where('sinav_resim_id', '=', $this->sinav_id)
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

        $this->active_page = Page::find($this->active_page_id);
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
    }

    public function editKapsam()
    {
        $this->isKapsamEdit
            ? ($this->isKapsamEdit = false)
            : ($this->isKapsamEdit = true);
    }
}
