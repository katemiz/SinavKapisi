<?php

namespace App\Http\Livewire;

use App\Models\KagitSinav;
use App\Models\KapsamSinav;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Livewire\WithPagination;

class KagitSinavlar extends Component
{
    use WithPagination;

    public $ksinavlar;
    public $search = '';
    public $notification = false;
    public $sortField = 'title';
    public $sortDirection = 'asc';

    public $sortTimeField = 'created_at';
    public $sortTimeDirection = 'desc';

    // protected $listeners = [
    //     'deletePage' => 'deletePage',
    // ];

    public function paginationView()
    {
        return 'livewire::my-pagination';
    }

    public function getKSinavlar()
    {
        $q = KagitSinav::query()->orderBy(
            $this->sortTimeField,
            $this->sortTimeDirection
        );

        if (!blank($this->search)) {
            $q->where('name', 'like', '%' . $this->search . '%');
        }

        return $q->paginate(Config::get('constants.table.no_of_results'));
    }

    public function render()
    {
        return view('livewire.kagit-sinavlar', [
            'kagit_sinavlar' => $this->getKSinavlar(),
        ]);
    }
}
