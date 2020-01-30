<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImasShikoUsers extends Model
{
    protected $table = 'shiko_users';
    protected $primaryKey = 'user_id';


    /**
     * ユーザーの作成
     *
     * @param string $usrToken
     * @return bool
     */
    public function create(string $usrToken) {
        return $this->insert(['user_token' => $usrToken]) ? true : false;
    }


    /**
     * トークンのバリデーション
     * 存在すればuser_idを返す
     *
     * @param string $token
     * @return bool
     */
    public function findUserId(string $usrToken) {
        $usrData = $this->select('user_id')->where(['user_token' => $usrToken])->get();
        return !empty($usrData) ? $usrData : false;
    }

}
