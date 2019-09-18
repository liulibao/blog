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

Route::post('/login', 'LoginController@index');

Route::middleware(['api.auth'])->group(function () {
    Route::get('user', 'HomeController@index');
    Route::get('home', 'HomeController@home');
    Route::get('logout', 'LoginController@logout');
});
//Route::get('logout', 'LoginController@logout');
//Route::post('refresh', 'LoginController@refresh');


//测试中间件
Route::middleware('test')->group(function () {
    Route::get('test', function (){
        return '123456';
    });
});