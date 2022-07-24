<?php

namespace App\Http\Livewire;

use App\Models\Page;
use App\Models\SinavResim;
use Livewire\Component;

class SinavResimView extends Component
{
    public $sinav_id = false;
    public $sinav = false;
    public $sayfalar = false;
    public $active_page_id = false;
    public $active_page_data = false;

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
        $sayfa = Page::find($this->active_page_id);

        $this->active_page_data = Page::imgEncode($sayfa->stored_as);
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
}
