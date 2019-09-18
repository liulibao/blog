<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //将菜单视为公共区域
//        View::composer('admin.layouts._sidebar', function($view) {
//            $view->with('privileges', 'test');
//        });
        // 自定义验证规则 不为空的情况进行验证
        Validator::extend('not_empty', function ($attribute, $value, $parameters) {
            return !empty($value) ? is_numeric($value) : true;
        });
    }



    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
