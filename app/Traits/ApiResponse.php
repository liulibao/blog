<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/4
 * Time: 15:46
 */

namespace App\Traits;


class ApiResponse
{
    /**
     * 成功响应
     * @param array $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     * @internal param int $code
     * @internal param array $data
     */
    public static function success($data = array(), $message = '操作成功', $status = 1)
    {
        $info = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
        return response()->json($info);
    }


    /**
     * 失败响应
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     * @internal param
     */
    public static function error($message = '操作失败', $status = 0)
    {
        $info = array(
            'status' => $status,
            'message' => $message
        );
        return response()->json($info);
    }

    /**
     * 请求参数错误直接返回错误页面并提示
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function requestError($message = '请求参数错误')
    {
        setRequestError($message);
        return redirect('error');
    }
}