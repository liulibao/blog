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
        Route::get('admin/error', 'HomeController@error')->name('admin.error');

        //用户管理
        Route::namespace('User')->group(function () {
            Route::get('user', 'UserController@index')->name('admin.user');
            Route::get('user/subscriber', 'UserController@subscriber')->name('admin.subscriber');
            Route::get('user/delete', 'UserController@delete')->name('admin.delete');
        });

        //系统管理
        Route::namespace('System')->group(function () {
            //角色管理
            Route::get('role', 'RoleController@index')->name('admin.role');
            Route::get('role/edit', 'RoleController@edit')->name('admin.role.edit');
            Route::get('role/delete', 'RoleController@delete')->name('admin.role.delete');
            Route::post('role/store', 'RoleController@store')->name('admin.role.store');

            //菜单管理
            Route::get('menu', 'MenuController@index')->name('admin.role');
            Route::get('menu/edit', 'MenuController@edit')->name('admin.role.edit');
            Route::get('menu/delete', 'MenuController@delete')->name('admin.role.delete');
            Route::post('menu/store', 'MenuController@store')->name('admin.role.store');
        });

        //文章管理
        Route::namespace('Article')->group(function () {
            Route::get('article', 'ArticleController@index')->name('admin.article');
            Route::get('article/edit', 'ArticleController@edit')->name('admin.article.edit');
            Route::get('article/delete', 'ArticleController@delete')->name('admin.article.delete');
            Route::post('article/store', 'ArticleController@store')->name('admin.article.store');

            Route::get('article/category', 'ArticleCategoryController@index')->name('admin.article.category');
            Route::get('article/category/edit', 'ArticleCategoryController@edit')->name('admin.article.category.edit');
            Route::get('article/category/delete', 'ArticleCategoryController@delete')->name('admin.article.category.delete');
            Route::post('article/category/store', 'ArticleCategoryController@store')->name('admin.article.category.store');
        });

        //日记管理
        Route::namespace('Diary')->group(function () {
            Route::get('diary', 'DiaryController@index')->name('admin.diary');
            Route::get('diary/edit', 'DiaryController@edit')->name('admin.diary.edit');
            Route::get('diary/delete', 'DiaryController@delete')->name('admin.diary.delete');
            Route::post('diary/store', 'DiaryController@store')->name('admin.diary.store');
        });

        //广告管理
        Route::namespace('Advert')->group(function (){
            Route::get('advert', 'AdvertController@index')->name('admin.advert');
            Route::get('advert/edit', 'AdvertController@edit')->name('admin.advert.edit');
            Route::get('advert/delete', 'AdvertController@delete')->name('admin.advert.delete');
            Route::get('advert/deleteFile', 'AdvertController@deleteFile')->name('admin.advert.deleteFile'); //删除文件
            Route::post('advert/store', 'AdvertController@store')->name('admin.advert.store');
            Route::post('advert/uploadFile', 'AdvertController@uploadFile')->name('admin.advert.uploadFile'); //上传文件
        });


        Route::get('/icons', function () {
            return view('admin.dashboard.icons');
        });
    });
}
