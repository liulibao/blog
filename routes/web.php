<?php

Route::get('test', 'LoginController@test');
Route::post('login', 'LoginController@index');
Route::get('error', 'CommonController@error');

Route::get('', 'IndexController@index');
Route::namespace('Article')->group(function() {
    Route::get('article/detail/{id}', 'ArticleController@detail');
});
