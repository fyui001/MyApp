<?php

namespace App\Http\Controllers;

use App\Model\OnlyLoveYou;
use App\Http\Requests\OnlyLoveYouRequest;

class OnlyLoveYouController extends Controller
{

    /**
    * お前しか好きじゃない一覧取得
    *
    * @return array
    */
    public function index() {

        $OnlyLoveYou = new OnlyLoveYou;
        $resultDatas = $OnlyLoveYou->get();

        if ( $resultDatas->isNotEmpty() ) {
            return [
                'status' => true,
                'resultData' => $resultDatas
                ];
        } else {
            return [
                'status' => false,
                'msg' => 'エラーが発生しました'
            ];
        }

    }

    /**
     * 投稿者、声優、サーバーのいずれかで検索
     *
     * @param OnlyLoveYouRequest $request
     * @return array
     */
    public function show(OnlyLoveYouRequest $request) {
        $OnlyLoveYou = new OnlyLoveYou;
        $searchResult = $OnlyLoveYou->search($request['searchKeyword']);

        if ( $searchResult->isNotEmpty() ) {
            return [
                'status' => true,
                'resultData' => $searchResult
            ];
        } else {
            return [
                'status' => false,
                'msg' => '何も見つかりませんでした。'
            ];
        }
    }

}
