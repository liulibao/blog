<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 21:55
 */

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

/**
 * 为了省事，不想写重复的方法
 * Interface MethodInterface
 * @package App\Http\Controllers\Admin
 */
interface MethodInterface
{
    /**
     * 列表首页
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request);

    /**
     * 编辑页面
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request);

    /**
     * 保存数据
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);

    /**
     * 删除操作
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request);
}