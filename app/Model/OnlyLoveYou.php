<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OnlyLoveYou extends Model
{
    protected $table = 'only_love_you';

    /**
    * お前しか好きじゃないの全県取得
    *
    * @return array
    */
    public function get() {

        return $this->select('UserName', 'Content', 'Love', 'Guild', 'create_at')
                    ->where(['del_flg' => 0])
                    ->orderBy('id', 'desc')
                    ->paginate(20);

    }

    /**
     * ユーザー名、お前しか好きじゃない声優、サーバー名いずれかの検索結果
     *
     * @param string
     * @return bool
     */
    public function search(string $keyword) {

        return $this->select('UserName', 'Content', 'Love', 'Guild', 'create_at')
                    ->where(['del_flg' => 0])
                    ->where('UserName', 'like', "%{$keyword}%")
                    ->where('Love', 'like', "%{$keyword}%")
                    ->where('Guild', 'like', "%{$keyword}%")
                    ->orderBy('id', 'desc')->paginate(20);
    }

}
