<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 22:00
 */
if(config('domain.admin.domain')){
    Route::domain(config('domain.admin.domain'))
        ->middleware('web')
        ->group(function () {

        //首页
        Route::get('/', 'HomeController@index')->name('home');

        Route::namespace('Article')->group(function () {
            Route::get('article', 'ArticleController@index')->name('admin.article');
            Route::get('article/category', 'ArticleCategoryController@index')->name('admin.article.category');
            Route::get('article/category/edit', 'ArticleCategoryController@edit')->name('admin.article.category.edit');
            Route::post('article/category/store', 'ArticleCategoryController@store')->name('admin.article.category.store');
        });

        Route::get('/icons', function () {
            return view('admin.dashboard.icons');
        });


    });
}
