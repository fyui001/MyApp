<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ImasVoiceActors;
use App\Model\ImasVoiceActorShikoUsers;
use App\Model\ImasVoiceActorShikoLists;
use App\Http\Requests\ShikoCheckListRequest;
use App\Library\Libraries;

class ImasVoiceActorShikoCheckListController extends Controller
{

    /**
     * ユーザートークンの正当性を調べる。
     * すでに存在していればtrue存在していなければfalseを返す。
     *
     * @param string $userToken
     * @return bool
     */
    protected function validateUserToken(string $userToken) {
        $users = new ImasVoiceActorShikoUsers;
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
        $imasVoiceActors = new ImasVoiceActors;
        $shikoUsers = new ImasVoiceActorShikoUsers;
        $shikoList = new ImasVoiceActorShikoLists;
        $voiceActors = $imasVoiceActors->getVoiceActors();

        if (!$voiceActors->isNotEmpty()) {
            return [
                'msg' => '声優の取得に失敗しました',
                'status' => false
            ];
        }

        if ( !isset($request['usrToken']) || !$this->validateUserToken($request['usrToken']) ) {
            return [
                'voiceActors' => $voiceActors,
                'status' => true
            ];
        }

        $usrId = $shikoUsers->findUserId($request['usrToken']);

        if ($usrId->isNotEmpty()) {
            $shikoListData = $shikoList->get($usrId[0]['user_id']);
            return [
                'voiceActors' => $voiceActors,
                'shikoList' => $shikoListData,
                'status' => true
            ];
        } else {
            return [
                'msg' => '何もみつかりません',
                'status' => false
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

        $shikoUsers = new ImasVoiceActorShikoUsers;
        $shikoList = new ImasVoiceActorShikoLists;
        $libraries = new Libraries;

        $usrToken = $libraries->tokenGen(64);
        while (!$this->validateUserToken($usrToken)) {
            $usrToken = $libraries->tokenGen(64);
        }

        if ( $shikoUsers->create($usrToken) && isset($request['shikoList']) ) {

            $usrId = $shikoUsers->findUserId($usrToken)[0]['user_id'];
            try {

                $shikoList->create($usrId, $request['shikoList']);
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
        $shikoUsers = new ImasVoiceActorShikoUsers;
        $shiko = new ImasVoiceActorShikoLists;

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
