<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\OnlyLoveYou;

class OnlyLoveYouController extends Controller
{
    public function index() {
        $OnlyLoveYou = new OnlyLoveYou;
        return $OnlyLoveYou->get() ?: 'データの取得に失敗';
    }
}
