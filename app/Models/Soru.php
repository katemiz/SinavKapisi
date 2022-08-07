<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soru extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'esorular';

    public function secenekler()
    {
        return $this->hasMany(CevapSecenek::class);
    }

    protected function sinav(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => KapsamSinav::find($attributes['kapsam_sinav_id'])->abbr,
        );
    }


    protected function dal(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => $attributes['kapsam_dal_id'] != null ? KapsamDal::find($attributes['kapsam_dal_id'])->title : false,
        );
    }


    protected function ders(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => $attributes['kapsam_ders_id'] != null ? KapsamDers::find($attributes['kapsam_ders_id'])->title:'',
        );
    }


    protected function cevapSayisi(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => CevapSecenek::where('soru_id','=',$attributes['id'])->count(),
        );
    }

    protected function dogruCevapSayisi(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => CevapSecenek::where('soru_id','=',$attributes['id'])->where('dogru_mu', true)->count(),
        );
    }



}
