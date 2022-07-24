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


    protected function sinav(): Attribute
    {
        return new Attribute(

            get: fn ($value, $attributes) => Kapsam::find($attributes['kapsam_id'])->parent_id < 1 ? Kapsam::find($attributes['kapsam_id'])->title : Kapsam::find(Kapsam::find(
                $attributes['kapsam_id']
            )->parent_id)->title.' - '.Kapsam::find($attributes['kapsam_id'])->title,
        );
    }









}
