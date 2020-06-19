<?php

namespace App\Services\Interfaces;

interface OnlyLoveYouServiceInterface
{
    public function getOnlyLoveYouList(): object;
    public function getOnlyLoveYouSearchList(string $keyword): object;
}
