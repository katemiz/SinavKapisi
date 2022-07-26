<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapsamDal extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'kapsam_dal';

    public function dersler()
    {
        return $this->hasMany(KapsamDers::class);
    }
}
