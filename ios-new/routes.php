<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('get-token', [
    'as' => 'get.token',
    'uses' => 'StickerpushController@getToken'
]);
Route::get('push-sticker', [
    'as' => 'push.sticker',
    'uses' => 'StickerpushController@pushSticker'
]);

Route::post('push-sticker-send', [
    'as' => 'push.stickersend',
    'uses' => 'StickerpushController@pushStickerSend'
]);
