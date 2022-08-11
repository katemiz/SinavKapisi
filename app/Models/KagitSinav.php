<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KagitSinav extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'kagit_sinavlar';

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



    protected function sinavabbr(): Attribute
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


    public function sinavSoruSayisi()
    {
        $sonuc = [
            'dallar' => false,
            'dersler' => false
        ];

        if ($this->kapsam_dal_id === null && $this->kapsam_ders_id === null)
        {
            $dallar = KapsamDal::where('kapsam_sinav_id','=',$this->kapsam_sinav_id)->get();

            foreach ($dallar as $dal) {
                $sonuc['dallar'][$dal->id] = $dal->ssayisi;
            }
        }

        if ($this->kapsam_dal_id != null && $this->kapsam_ders_id === null)
        {
            $dal = KapsamDal::find($this->kapsam_dal_id);

            $sonuc['dallar'][$dal->id] = $dal->ssayisi;
            $dersler = KapsamDers::where('kapsam_dal_id','=',$dal->id)->get();

            foreach ($dersler as $ders) {
                $sonuc['dersler'][$ders->id] = $ders->ssayisi;
            }
        }

        if ($this->kapsam_dal_id != null && $this->kapsam_ders_id != null)
        {
            $ders = KapsamDers::find($this->kapsam_ders_id);
            $sonuc['dersler'][$ders->id] = $ders->ssayisi;
        }

        return $sonuc;
    }


    public function soruDizini()
    {
        $tum_sorular = [];

        $sinavSayiDizini = $this->sinavSoruSayisi();

        foreach ($sinavSayiDizini as $k => $valueArr) {

            if ($valueArr) {

                foreach ($valueArr as $kk => $ssayisi) {
                    $temp = [];

                    for ($i = 1; $i <= $ssayisi; $i++) {
                        $temp[$i] = null;
                    }
                    $tum_sorular[$k][$kk] = $temp;
                }

            } else {
                $tum_sorular[$k] = false;
            }
        }

        return $tum_sorular;
    }




}





