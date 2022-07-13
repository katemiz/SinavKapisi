<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapsam extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'kapsam';

    public function parent()
    {
        return $this->belongsToOne(static::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id')->orderBy(
            'title',
            'asc'
        );
    }

    public function getSinavlar()
    {
        return Kapsam::where('tur', '=', 'sinav');
    }

    public function getDersler($parent_id)
    {
        return Kapsam::where('tur', '=', 'ders')->where(
            'parent_id',
            '=',
            $parent_id
        );
    }

    public function getSinavlarDersler()
    {
        $sinav_ders = [];

        foreach ($this->getSinavlar() as $sinav) {
            $sinav_ders[$sinav->id][] = $this->getDersler($sinav->id);
        }
    }
}
