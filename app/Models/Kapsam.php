<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapsam extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'kapsam';

    // public function getParent()
    // {
    //     return Kapsam::find($this->id);
    // }
}
