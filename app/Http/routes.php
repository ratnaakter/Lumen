<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$app->get('/', function () use ($app) {
   // return $app->version();
	return view('welcome');
});*/


$app->get('api/article','ExampleController@index');

$app->get('api/article/{id}','ExampleController@getArticle');

$app->post('api/article','ExampleController@saveArticle');

$app->put('api/article/{id}','ExampleController@updateArticle');

$app->delete('api/article/{id}','ExampleController@deleteArticle');
