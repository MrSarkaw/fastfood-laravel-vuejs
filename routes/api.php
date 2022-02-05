<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' =>['auth:api','throttle:500,1']], function () {
    Route::apiResources([
        'users'=>'userController',
        'foods'=>'foodsController',
        'orderFood'=>'orderFoodController',
        'report'=>'report',
        'backup'=>'backup'
    ]);
    Route::get('/countData','userController@countData');
    Route::get('/currentUser','userController@currentUser');
    Route::get('/searchFood/{search}','foodsController@search');
    Route::get('/indexOrder','foodsController@indexOrder');
    Route::put('/order/{id}','foodsController@order');
    Route::put('/singleOrderUpdate/{id}','foodsController@singleOrderUpdate');
    Route::get('/singleOrder/{id}','foodsController@singleOrder');
    Route::get('/filterSearch','report@filterSearch');
});
