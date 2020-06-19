<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlyLoveYou extends Model
{

    protected $table = 'only_love_you';

    protected $fillable = [
        'user',
        'content',
        'love',
        'guild',
        'del_flg',
    ];

}
