<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) { //表单验证处理
            return ApiResponse::error(array_first(array_collapse($exception->errors())), 400);
//            return response(['error' => array_first(array_collapse($exception->errors()))], 400);
        } else if ($exception instanceof UnauthorizedHttpException) {
            // 参数验证错误的异常，我们需要返回 400 的 http code 和一句错误信息
            // 用户认证的异常，我们需要返回 401 的 http code 和错误信息
//            return response($exception->getMessage(), 401);
            return ApiResponse::error($exception->getMessage(), 401);
        } else if($exception instanceof RepositoryException) {
            return ApiResponse::error($exception->getMessage(), 401);
        }
        return parent::render($request, $exception);
    }
}
