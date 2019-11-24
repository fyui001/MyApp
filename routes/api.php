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

Route::prefix('shiko')->group(function() {
   Route::get('/get', 'ImasVoiceActorShikoCheckListController@index')->middleware('cors');
   Route::post('/create', 'ImasVoiceActorShikoCheckListController@create')->middleware('cors');
   Route::post('update', 'ImasVoiceActorShikoCheckListController@store')->middleware('cors');
});
