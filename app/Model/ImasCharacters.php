<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImasCharacters extends Model
{
    protected $table = 'imas_characters';
    protected $primaryKey = 'id';

    /**
     * アイマス声優のリスト全件を返す
     *
     * @return bool
     */
    public function getImasCharacters() {
        return $this->get();
    }
}
