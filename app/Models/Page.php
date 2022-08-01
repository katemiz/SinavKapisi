<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

use Image;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'pages';



    public function sorular()
    {
        return $this->hasMany(ResimSoru::class);
    }



    public static function imgEncode($imagepath)
    {
        $gorsel = Image::make(Storage::path($imagepath));

        return (string) $gorsel->encode('data-url');
    }

    public static function createThumb($imagepath)
    {
        $p = pathinfo($imagepath);

        $thumb =
            $p['dirname'] . '/THUMBS/' . $p['filename'] . '.' . $p['extension'];

        $intImg = Image::make(Storage::path($imagepath));
        $intImg = $intImg->orientate();

        $intImg->resize(Config::get('constants.thumbnail.max_dimension'), Config::get('constants.thumbnail.max_dimension'), function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        Storage::disk('local')->put($thumb, (string) $intImg->encode());

        return $thumb;
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) =>
                Image::make(Storage::path($value))
                    ->encode('data-url'),
        );
    }










}
