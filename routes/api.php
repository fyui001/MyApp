<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* お前しか好きじゃない */
Route::prefix('only_love_you')->group(function() {
    Route::get('/get', 'OnlyLoveYouController@index')->middleware('cors');
    Route::get('/search', 'OnlyLoveYouController@show')->middleware('cors');
});

/* アイマス声優シコチェックリスト */
Route::prefix('shiko')->group(function() {
   Route::get('/get', 'ImasShikoCheckListController@index')->middleware('cors');
   Route::get('/show', 'IMasShikoCheckListController@show')->middleware('cors');
   Route::post('/create', 'ImasShikoCheckListController@create')->middleware('cors');
   Route::post('/update', 'ImasShikoCheckListController@store')->middleware('cors');
});
