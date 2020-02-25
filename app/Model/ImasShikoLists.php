<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImasShikoLists extends Model
{
    protected $table = 'shiko_list';
    protected $primaryKey = 'id';


    /**
     * シコチェックリストの取得
     *
     * @param int $usrId
     * @return bool
     */
    public function get(int $usrId) {
        return $this->select('shiko_list', 'voice_actor_flg')->where(['owner_id' => $usrId])->get();
    }


    /**
     * 新規シコチェックリストの作成
     *
     * @param int    $usrId
     * @param string $shikoCheckList
     * @return bool
     */
    public function create(int $usrId, string $shikoList, int $voice_actor_flg) {
        return $this->insert(['owner_id' => $usrId, 'shiko_list' => $shikoList, 'voice_actor_flg' => $voice_actor_flg]) ? true: false;
    }


    /**
     * シコチェックリストの更新
     *
     * @param int    $usrId
     * @param string $shikoList
     * @return bool
     */
    public function updateShikoList(int $usrId, string $shikoList) {
        return $this->where(['owner_id' => $usrId])->update(['shiko_list' => $shikoList]);
    }
}
