<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 22:00
 */

Route::get('/', 'HomeController@index')->name('home');

Route::namespace('Article')->group( function (){
    Route::get('article', 'ArticleController@index')->name('article/index');
});
