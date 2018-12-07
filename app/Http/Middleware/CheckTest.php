<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/5
 * Time: 16:43
 */

namespace App\Http\Middleware;


use App\Traits\ApiResponse;
use Closure;

class CheckTest
{
    public  function handle($request, Closure $next)
    {
        if(is_numeric($request->age) && $request->age <= 10){
            return ApiResponse::error();
        }

        return $next($request);
    }
}