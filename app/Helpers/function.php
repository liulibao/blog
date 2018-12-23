<?php

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
