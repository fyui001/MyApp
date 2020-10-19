<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImasCharactor extends Model
{

    protected $table = 'imas_charactors';

    protected $fillable = [
        'name',
        'name_kana',
        'age',
        'bust',
        'hip',
        'waist',
        'color',
        'voice_actor',
        'title',
    ];

}
