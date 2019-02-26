<?php

if(!function_exists('handPagination')) {
    /**
     * 手动分页
     * @param $data 【数组】
     * @param $page 【页码】
     * @param $url 【跳转路径】
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator 【每页数目|int $perPage 每页数目】
     */
    function handPagination($data, $page, $url, $perPage=10){
        $item = array_slice($data, ($page-1)*$perPage, $perPage);
        $total = count($data);
        $paginate =new \Illuminate\Pagination\LengthAwarePaginator($item, $total, $perPage, $page, [
            'path' => $url,
            'pageName' => 'page'
        ]);

        return $paginate;
    }
}

if(!function_exists('getSummary')) {
    /**
     * 获取内容摘要
     * @param $content
     * @param int $start
     * @param int $end
     * @param string $char
     * @return null|string
     */
    function getSummary($content, $start = 0, $end = 150, $char = 'utf-8')
    {
        if (empty($content)) {
            return null;
        }
        return (mb_substr(str_replace(' ', '', strip_tags($content)), $start, $end, $char));
    }
}

if(!function_exists('grabPictures')){
    /**
     * 抓取内容全部图片
     * @param $str
     * @return null
     */
    function grabPictures($str)
    {
        if (empty($str)) {
            return '';
        }

        $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern, $str, $match);

        if(!empty($match[1])) {
            return $match[1][0];
        }

        return '';
    }
}

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
   function setCache($key, $value, $time = 3600) {
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
        return  bindec(decbin($ip)); //无符号的整型数
    }
}

if(!function_exists('getLong2IpCurrentIp')){
    /**
     * 获取当前的IP(还原ip段)
     * @return string
     */
    function getCurrentLong2Ip($ip)
    {
        if (!$ip || intval($ip) < 0 ) {
            return '';
        }

        return
             long2ip($ip);
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
