<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CevapSecenek extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'ecevap_secenekler';
}
