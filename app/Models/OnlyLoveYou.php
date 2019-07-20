<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OnlyLoveYou extends Model
{
    protected $table = 'only_love_you';

    public function get() {
        return $this->get() ?: false;
    }

}
