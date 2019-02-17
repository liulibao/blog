<?php

if(!function_exists('setRequestError')) {
    /**
     * 设置请求错误信息
     * @param $key
     * @return mixed
     */
    function setRequestError($value, $key = 'request_error') {

        return \Session::put($key, $value);
    }
}

if(!function_exists('getCache')) {
    /**
     * 获取缓存
     * @param $key
     * @return mixed
     */
   function getCache($key) {
       return \Illuminate\Support\Facades\Cache::get($key);
   }
}

if(!function_exists('setCache')) {
    /**
     * 设置缓存
     * @param $key
     * @return mixed
     */
   function setCache($key, $value, $time) {
       return \Illuminate\Support\Facades\Cache::add($key, $value, $time);
   }
}

if(!function_exists('delCache')) {
    /**
     * 删除缓存
     * @param $key
     * @return mixed
     */
   function delCache($key) {
       return \Illuminate\Support\Facades\Cache::forget($key);
   }
}

if(!function_exists('format_url')) {
    /**
     * 格式化url 路由
     * @param $url
     * @return array
     */
    function format_url ($url)
    {
         return explode('/', $url);
    }
}

if(!function_exists('isGet')) {
    /**
     * 是否是 get 请求
     * @return mixed
     */
    function isGet ()
    {
        return \Request::isMethod('get');
    }
}

if(!function_exists('isPost')) {
    /**
     * 是否是 post 请求
     * @return mixed
     */
    function isPost ()
    {
        return \Request::isMethod('post');
    }
}


if(!function_exists('isAjax')) {
    /**
     * 是否是 ajax 请求
     * @return mixed
     */
    function isAjax ()
    {
        return Request()->ajax();
    }
}

if(!function_exists('getCurrentIp')){
    /**
     * 获取当前的IP
     * @return number
     */
    function getCurrentIp()
    {
        $ip = ip2long(request()->getClientIp());
        return  bindec(decbin($ip));
    }
}

if(!function_exists('getCurrentUrl')) {
    /**
     * 获取当前的完整路不含有参数
     * @return mixed
     */
    function getCurrentUrl(){
        $route = getCurrentFullRoute();
        return explode('?', $route)[0];
    }
}

if(!function_exists('getCurrentFullRoute')){
    /**
     * 获取当前的完整路由含有参数
     * @return mixed
     */
    function getCurrentFullRoute()
    {
        return trim(\Request::getRequestUri(), '/');
    }

}

if(!function_exists('getCurrentRoute')){
    /**
     * 获取当前的route 路由
     * @return mixed
     */
    function getCurrentRoute()
    {
        return \Request::route()->getName();
    }

}

if(!function_exists('getCurrentControllerName')){
    /**
     * 获取控制器全路径
     * @return mixed
     */
    function getCurrentControllerName()
    {
        return getCurrentAction()['controller'];
    }

}

if(!function_exists('getCurrentMethodName')) {
    /**
     * 获取方法名
     * @return mixed
     */
    function getCurrentMethodName() {
        return getCurrentAction()['method'];
    }

}

if(!function_exists('getCurrentAction')) {
    /**
     * 获取当前控制器与方法
     * @return array
     */
    function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);

        return ['controller' => $class, 'method' => $method];
    }
}

if (!function_exists('format_array')) {
    /**
     * 格式化数组
     * @param $arr 【需要格式化的数组】
     * @param $key_name 【指定的key】
     * @param bool $is_all 【是否获取全部值】
     * @param $val_name 【指定获取的字段】
     * @return array
     */
    function format_array($arr, $key, $value, $is_all = false)
    {
        $result = array();
        array_walk($arr, function($item, $ke) use (&$result, $key, $value , $is_all){
            if($is_all){
                $result [$item[$key]] = $item;
            } else {
                $result [$item[$key]] = $item[$value];
            }
        });
        return $result;
    }

}

if(!function_exists('format_data_tree')){
    /**
     *  组装分级菜单
     * @param array $items 菜单节点
     * @param int $pid
     * @return array
     */
    function format_data_tree($items, $pid = 0)
    {
        $result = array();
        if(gettype($items) === 'object') {
            foreach($items as $v){
                if($v->pid == $pid){
                    $v->children = format_data_tree($items, $v->id);
                    $result[] = $v;
                }
            }
        } else {
            foreach($items as $v) {
                if($v['pid'] == $pid){
                    $v['children'] = format_data_tree($items, $v['id']);
                    $result[] = $v;
                }
            }
        }

        return $result;
    }

}
