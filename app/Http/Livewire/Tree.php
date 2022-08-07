<?php

namespace App\Http\Livewire;

use App\Models\Kapsam;
use App\Models\KapsamDal;
use App\Models\KapsamDers;
use App\Models\KapsamSinav;
use Illuminate\Support\Arr;
use Livewire\Component;

class Tree extends Component
{
    public $treearray = [];
    public $vturu = 'sinav';

    public $yeni = [];

    protected $listeners = [
        'add' => 'add',
        'update' => 'update',
        'delete' => 'delete',
    ];

    public function mount()
    {
        $sinavlar = KapsamSinav::all()->toArray();
        $dallar = KapsamDal::all()->toArray();
        $dersler = KapsamDers::all()->toArray();

        $newid = 1;

        foreach ($sinavlar as $sinav) {
            $sinav['parent_id'] = 0;
            $sinav['newid'] = $newid;
            $sinav['tur'] = 'sinav';

            $this->yeni[] = $sinav;

            foreach ($dallar as $dal) {
                if ($dal['kapsam_sinav_id'] == $sinav['id']) {
                    $dal['parent_id'] = $sinav['newid'];
                    $dal['newid'] = ++$newid;

                    $dal['tur'] = 'dal';

                    array_push($this->yeni, $dal);
                }
            }
        }

        // foreach ($dallar as $dal) {
        //     $dal['parent_id'] = $dal['kapsam_sinav_id'];
        //     $dal['newid'] = $newid++;

        //     array_push($this->yeni, $dal);
        //     // $this->yeni[] = $dal;
        // }

        //dd($this->yeni);

        // foreach ($dersler as $ders) {
        //     $ders['parent_id'] = $ders['kapsam_dal_id'];
        //     $this->yeni[] = $ders;
        // }
    }

    function buildTree(array $flatList)
    {
        $grouped = [];
        foreach ($flatList as $node) {
            $grouped[$node['parent_id']][] = $node;
        }

        $fnBuilder = function ($siblings) use (&$fnBuilder, $grouped) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling['newid'];
                if (isset($grouped[$id])) {
                    $sibling['children'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }
            return $siblings;
        };

        return $fnBuilder($grouped[0]);
    }

    public function treeToTableSIL($array, $level = 0)
    {
        foreach ($array as $branch) {
            $branchcopy = $branch;
            $branchcopy['level'] = $level;
            unset($branchcopy['children']);

            if (isset($branch['children'])) {
                $level++;
                $this->treeToTable($branch['children'], $level);
            }

            $level = 0;
        }

        return true;
    }

    public function render()
    {
        // $rows = KapsamSinav::all()->toArray();

        // $flattened = Arr::dot($rows);

        // if (count($rows) > 0) {
        //     $this->treearray = $this->buildTree($rows, 'parent_id', 'id');
        // }

        if (count($this->yeni) > 0) {
            $this->treearray = $this->buildTree($this->yeni);
        }

        dd($this->treearray);

        //$this->treearray = $rows;

        return view('livewire.tree');
    }

    public function deneme()
    {
        dd('oldu');
    }

    public function add($fdata)
    {
        $p['tur'] = $fdata['tur'];
        $p['parent_id'] = $fdata['parent_id'];
        $p['title'] = $fdata['title'];

        Kapsam::create($p);
    }

    public function update($fdata)
    {
        $p['parent_id'] = $fdata['parent_id'];
        $p['title'] = $fdata['title'];

        Kapsam::find($fdata['id'])->update($p);
    }

    public function delete($id)
    {
        Kapsam::find($id)->delete();
    }
}
