<?php

namespace App\Http\Livewire;

use App\Models\Konu;
use Livewire\Component;

class Tree extends Component
{
    public $rows;
    public $rowsarray;
    public $treearray;
    public $tablearray;

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

    public function treeToTable($array, $level = 0)
    {
        foreach ($array as $branch) {
            $branchcopy = $branch;
            $branchcopy['level'] = $level;
            unset($branchcopy['children']);
            $this->tablearray[] = $branchcopy;

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
        $this->rows = Konu::all();
        $this->rowsarray = $this->rows->toArray();
        $this->treearray = $this->buildTree(
            $this->rowsarray,
            'parent_id',
            'id'
        );
        $this->treeToTable($this->treearray);

        //$this->tablearray = (object) $this->tablearray;

        return view('livewire.tree');
    }

    public function deneme()
    {
        dd('oldu');
    }
}
