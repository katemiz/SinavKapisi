<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapsamSinav extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'kapsam_sinav';

    public function dallar()
    {
        return $this->hasMany(KapsamDal::class);
    }

    public function dersler()
    {
        return $this->hasMany(KapsamDers::class);
    }


    protected function sinavAdi(): Attribute
    {
        return new Attribute(

            // get: fn ($value, $attributes) => KapsamSinav::find($attributes['id'])->title,
            get: fn ($value, $attributes) => $attributes['title'],

        );
    }


    // protected function directDersler(): Attribute
    // {
    //     return new Attribute(

    //         get: fn ($value, $attributes) => KapsamDers::whereNull('kapsam_dal_id')->where('kapsam_sinav_id','=',$attributes['id']),
    //     );
    // }
}
