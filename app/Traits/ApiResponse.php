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
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     * @internal param array $dat
     */
    public static function success($data = array(), $message = '操作成功', $code = 1)
    {
        $info = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        return response()->json($info);
    }


    /**
     * 失败响应
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = '操作失败', $code = 0)
    {
        $info = array(
            'code' => $code,
            'message' => $message
        );
        return response()->json($info);
    }
}