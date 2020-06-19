<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImasVoiceActorShikoLists extends Model
{
    protected $table = 'shiko';
    protected $primaryKey = 'id';


    /**
     * シコチェックリストの取得
     *
     * @param int $usrId
     * @return bool
     */
    public function get(int $usrId) {
        return $this->select('shiko_list')->where(['owner_id' => $usrId])->get();
    }


    /**
     * 新規シコチェックリストの作成
     *
     * @param int    $usrId
     * @param string $shikoCheckList
     * @return bool
     */
    public function create(int $usrId, string $shikoList) {
        return $this->insert(['owner_id' => $usrId, 'shiko_list' => $shikoList]) ? true: false;
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
