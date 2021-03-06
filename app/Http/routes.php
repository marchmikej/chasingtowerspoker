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
Route::group(['middleware' => ['auth']], function()
{
	Route::get('/', 'HomeController@index');
	Route::post('/', 'HomeController@submitblog');
	Route::get('addgame', 'HomeController@addgame');
	Route::post('addgame', 'HomeController@storegame');
	Route::get('updategamestanding/{id}', 'HomeController@updateStandings');
	Route::post('updategamestanding/{id}', 'HomeController@storeStandings');
	Route::post('updategamefinish', 'HomeController@updateGameFinish');
	Route::get('seasons', 'HomeController@seasons');
	Route::get('seasons/{id}', 'HomeController@showseason');
	Route::get('seasons/game/{id}', 'HomeController@game');
	Route::get('showgames', 'HomeController@showgames');
	Route::get('profile', 'HomeController@profile');
	Route::post('updatepassword', 'HomeController@updatepassword');
});

Route::auth();
