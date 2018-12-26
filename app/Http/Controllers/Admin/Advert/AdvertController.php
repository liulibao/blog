<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 19:03
 */

namespace App\Http\Controllers\Advert;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\MethodInterface;
use Illuminate\Http\Request;

class AdvertController extends BaseController implements MethodInterface
{
    /**
     * 列表首页
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $page_title = '广告列表';
        return view('admin.advert.index', compact('page_title'));
    }

    /**
     * 编辑页面
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        // TODO: Implement edit() method.
    }

    /**
     * 保存数据
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    /**
     * 删除操作
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        // TODO: Implement delete() method.
    }
}