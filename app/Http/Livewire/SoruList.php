<?php

namespace App\Http\Livewire;

use App\Models\Soru;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Livewire\WithPagination;

class SoruList extends Component
{
    use WithPagination;

    public $notification = false;

    public $search = '';

    public $sortField = 'title';
    public $sortDirection = 'asc';

    public $sortTimeField = 'created_at';
    public $sortTimeDirection = 'desc';

    public function deneme()
    {
        $q = Soru::query()->orderBy(
            $this->sortTimeField,
            $this->sortTimeDirection
        );

        // $q->where('user_id', '=', Auth::id());

        if (strlen($this->search) > 0) {
            $q->where('name', 'like', '%' . $this->search . '%');
        }

        return $q->paginate(Config::get('constants.table.no_of_results'));
    }

    public function paginationView()
    {
        return 'livewire::my-pagination';
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection =
                $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }

        if ($this->sortTimeField === $field) {
            $this->sortTimeDirection =
                $this->sortTimeDirection === 'asc' ? 'desc' : 'asc';
        }
    }

    public function ara($query)
    {
        $this->search = $query;
    }

    public function resetFilter()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.soru-list', [
            'sorular' => $this->deneme(),
        ]);
    }
}
