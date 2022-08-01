<?php

namespace App\Http\Livewire;

use App\Models\KapsamDal;
use App\Models\Page;
use App\Models\ResimSoru;
use App\Models\SinavResim;
use Livewire\Component;

class SinavResimView extends Component
{
    public $sinav_id = false;
    public $sinav = false;
    public $sayfalar = false;
    public $active_page_id = false;
    public $active_page = false;
    public $active_page_data = false;
    public $sayfaSayisi = false;

    protected $listeners = [
        'selectDal' => 'selectDal',
        'soruSayfaRelation' => 'soruSayfaRelation',
        'selectDogru' => 'selectDogru',
    ];

    public function mount()
    {
        $this->sinav_id = request('id');
        $this->sinav = SinavResim::find($this->sinav_id);
        $this->getPages();
    }

    public function render()
    {
        return view('livewire.sinav-resim-view', [
            'sinav' => $this->sinav,
        ]);
    }

    public function getPages()
    {
        $this->sayfalar = Page::where('sinav_resim_id', '=', $this->sinav_id)
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
            ResimSoru::where('page_id', $this->active_page_id)->delete();
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

            ResimSoru::create($props);
        }

        if ($islem == 'remove') {
            ResimSoru::where('page_id', $this->active_page_id)
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

        ResimSoru::where('page_id', $this->active_page_id)
            ->where('soruno', $soruNo)
            ->update($props);

        $this->active_page = Page::find($this->active_page_id);
    }
}
