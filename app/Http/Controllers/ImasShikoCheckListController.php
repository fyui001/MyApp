<?php

namespace App\Http\Controllers;

use App\Model\ImasCharacters;
use App\Model\ImasShikoUsers;
use App\Model\ImasShikoLists;
use App\Http\Requests\ShikoCheckListRequest;
use App\Library\Libraries;

class ImasShikoCheckListController extends Controller
{

    /**
     * ユーザートークンの正当性を調べる。
     * すでに存在していればtrue存在していなければfalseを返す。
     *
     * @param string $userToken
     * @return bool
     */
    protected function validateUserToken(string $userToken) {
        $users = new ImasShikoUsers;
        return $users->findUserId($userToken) ? true : false;
    }


    /**
     * 正しいユーザートークンであれば声優とシコった声優のリストを返却
     * ユーザートークンが無い若しくは不正な場合は声優リストのみを返す。
     *
     * @param ShikoCheckListRequest $request
     * @return array
     */
    public function index(ShikoCheckListRequest $request) {
        $imasVoiceActors = new ImasCharacters;
        $shikoUsers = new ImasShikoUsers;
        $shikoList = new ImasShikoLists;
        $voiceActors = $imasVoiceActors->getVoiceActors();

        if ( !isset($request['usrToken']) || !$this->validateUserToken($request['usrToken']) ) {
            return [
                'voiceActors' => $voiceActors
            ];
        }

        $usrId = $shikoUsers->findUserId($request['usrToken'])[0]['user_id'];
        $shikoListData = $shikoList->get($usrId);

        if ($shikoListData->isNotEmpty()) {
            return [
                'voiceActors' => $voiceActors,
                'shikoList' => $shikoListData
            ];
        } else {
            return [
                'voiceActors' => $voiceActors
            ];
        }
    }


    /**
     * 新しくシコチェックリストを保存する
     *
     * @param ShikoCheckListRequest $request
     * @return array
     */
    public function create(ShikoCheckListRequest $request) {

        $shikoUsers = new ImasShikoUsers;
        $shikoList = new ImasShikoLists;
        $libraries = new Libraries;

        $usrToken = $libraries->tokenGen(64);
        while (!$this->validateUserToken($usrToken)) {
            $usrToken = $libraries->tokenGen(64);
        }

        if ( $shikoUsers->create($usrToken) && isset($request['shikoList']) ) {

            $usrId = $shikoUsers->findUserId($usrToken)[0]['user_id'];
            try {

                $shikoList->create($usrId, $request['shikoList'], $request['voice_actor_flg']);
                return [
                  'status' => true,
                  'usrToken' => $usrToken
                ];

            } catch(\Exception $e) {

                return [
                  'status' => false,
                  'msg' => 'シコチェックリストの保存に失敗しました。'
                ];

            }
        } else {
            return [
                'status' => false,
                'msg' => 'シコチェックリストの保存に失敗しました。'
            ];
        }

    }

    /**
     * シコチェックリストの更新
     *
     * @param ShikoCheckListRequest $request
     * @return array
     */
    public function store(ShikoCheckListRequest $request) {
        $shikoUsers = new ImasShikoUsers;
        $shiko = new ImasShikoLists;

        if ( !isset($request['shikoList']) ) {
            return [
              'status' => false,
              'msg' => 'エラーが発生しました。'
            ];
        }

        try {

            if (isset($request['usrToken']) && $this->validateUserToken($request['usrToken']) ) {

                $shikoList = $request['shikoList'];
                $usrId = $shikoUsers->findUserId($request['usrToken'])[0]['user_id'];

                $shiko->updateShikoList($usrId, $shikoList);
                return [
                    'status' => true,
                    'msg' => '更新に成功しました'
                ];

            } else {
                throw new \Exception();
            }

        } catch(\Exception $e) {

            return [
              'status' => false,
              'msg' => '更新に失敗しました。'
            ];

        }

    }


}
