<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soru extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'sorular';



    public function secenekler()
    {
        return $this->hasMany(Secenek::class);
    }




    protected function ders(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => Kapsam::find(
                $attributes['kapsam_id']
            )->title,
        );
    }

    protected function sinav(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => Kapsam::find(Kapsam::find(
                $attributes['kapsam_id']
            )->parent_id)->abbr,
        );
    }

}
