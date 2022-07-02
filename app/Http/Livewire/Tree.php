<?php

namespace App\Http\Livewire;

use App\Models\Kapsam;
use Livewire\Component;

class Tree extends Component
{
    public $treearray = [];
    public $vturu = 'sinav';

    protected $listeners = [
        'add' => 'add',
        'update' => 'update',
        'delete' => 'delete',
    ];

    function buildTree(array $flatList)
    {
        $grouped = [];
        foreach ($flatList as $node) {
            $grouped[$node['parent_id']][] = $node;
        }

        $fnBuilder = function ($siblings) use (&$fnBuilder, $grouped) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling['id'];
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
        $rows = Kapsam::all()->toArray();

        if (count($rows) > 0) {
            $this->treearray = $this->buildTree($rows, 'parent_id', 'id');
        }

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
