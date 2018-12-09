<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/8
 * Time: 21:23
 */

namespace App\Http\Controllers\Admin\Article;


use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{

    public function index()
    {
        return view('admin.article.index');
    }

    public function edit()
    {

    }

    public function store()
    {

    }

    public function delete(Request $request)
    {

    }
}