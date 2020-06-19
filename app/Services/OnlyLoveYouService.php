<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Service as BaseService;
use App\Models\OnlyLoveYou;
use App\Services\Interfaces\OnlyLoveYouServiceInterface;

class OnlyLoveYouService extends BaseService implements OnlyLoveYouServiceInterface
{

    protected $keyword;

    /**
     * お前しか好きじゃないの全件取得
     *
     * @return object
     */
    public function getOnlyLoveYouList(): object {

        return OnlyLoveYou::where(['del_flg' => 0])
            ->orderBy('id', 'desc')
            ->paginate(20);

    }

    /**
     * 検索結果
     *
     * @param string $keyword
     * @return object
     */
    public function getOnlyLoveYouSearchList(string $keyword): object {

        $this->keyword = $keyword;

        return OnlyLoveYou::select('user', 'content', 'love', 'guild', 'created_at')
            ->where(['del_flg' => 0])
            ->where(function($query) {
                $query->where('user', 'like', "%{$this->keyword}%")
                    ->orWhere('love', 'like', "%{$this->keyword}%")
                    ->orWhere('guild', 'like', "%{$this->keyword}%");
            })
            ->orderBy('id', 'desc')->paginate(20);

    }

}
