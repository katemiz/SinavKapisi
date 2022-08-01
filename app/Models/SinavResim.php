<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinavResim extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'sinav_resim';

    public function sayfalar()
    {
        return $this->hasMany(Page::class);
    }

    // protected function sinav(): Attribute
    // {
    //     return new Attribute(

    //         get: fn ($value, $attributes) => Kapsam::find($attributes['kapsam_id'])->parent_id < 1 ? Kapsam::find($attributes['kapsam_id'])->title : Kapsam::find(Kapsam::find(
    //             $attributes['kapsam_id']
    //         )->parent_id)->title.' - '.Kapsam::find($attributes['kapsam_id'])->title,
    //     );
    // }

    protected function sinav(): Attribute
    {
        return new Attribute(

            get: fn ($value, $attributes) => KapsamSinav::find($attributes['kapsam_sinav_id'])->title,
        );
    }

    protected function dal(): Attribute
    {
        return new Attribute(

            get: fn ($value, $attributes) => $attributes['kapsam_dal_id'] != null ? KapsamDal::find($attributes['kapsam_dal_id'])->title : false,
        );
    }


    protected function dallar(): Attribute
    {
        return new Attribute(

            get: fn ($value, $attributes) => KapsamDal::where('kapsam_sinav_id','=',$attributes['kapsam_sinav_id'])->get(),
        );
    }




    protected function ders(): Attribute
    {
        return new Attribute(

            get: fn ($value, $attributes) => $attributes['kapsam_ders_id'] != null ? KapsamDers::find($attributes['kapsam_ders_id'])->title:'',
        );
    }


}
