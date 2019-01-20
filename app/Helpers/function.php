<?php

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

if(!function_exists('getCurrentUrl')){
    /**
     * 获取当前的url 路由
     * @return mixed
     */
    function getCurrentUrl()
    {
        return \Request::getRequestUri();
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
    function format_array($arr, $key_name, $val_name , $is_all = false)
    {
        $result = array();
        array_walk($arr, function($value, $key) use (&$result, $key_name, $val_name , $is_all){
            if($is_all){
                $result [$value[$key_name]] = $value;
            } else {
                $result [$value[$key_name]] = $value[$val_name];
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
