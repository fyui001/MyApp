<?php

namespace App\Http\Controllers;

use App\Models\OnlyLoveYou;
use App\Services\Interfaces\OnlyLoveYouServiceInterface;
use App\Http\Requests\OnlyLoveYouRequest;

class OnlyLoveYouController extends Controller
{

    protected $onlyLoveYouService;

    public function __construct(OnlyLoveYouServiceInterface $onlyLoveYouService) {

        $this->onlyLoveYouService = $onlyLoveYouService;

    }

    /**
    * お前しか好きじゃない一覧取得
    *
    * @return array
    */
    public function index() {

        $resultData = $this->onlyLoveYouService->getOnlyLoveYouList();

        if ( !$resultData->isNotEmpty() ) {
            return [
                'status' => false,
                'msg' => 'エラーが発生しました'
            ];
        }

        return [
            'status' => true,
            'resultData' => $resultData
        ];

    }

    /**
     * 投稿者、声優、サーバーのいずれかで検索
     *
     * @param OnlyLoveYouRequest $request
     * @return array
     */
    public function show(OnlyLoveYouRequest $request) {

        $searchResult = $this->onlyLoveYouService->getOnlyLoveYouSearchList($request['searchKeyword']);

        if ( !$searchResult->isNotEmpty() ) {
            return [
                'status' => false,
                'msg' => '何も見つかりませんでした。'
            ];
        }

        return [
            'status' => true,
            'resultData' => $searchResult
        ];

    }

}
