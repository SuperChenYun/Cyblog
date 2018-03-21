<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 调用ThinkPHP 内置json
 * @param $msg
 * @param array $data
 * @param $code
 * @return \think\response\Json
 */
function return_data($msg, $data=[], $code){
    $tmp_data = [ 'code' => $code, 'msg' => $msg, 'data' => $data];
    return json($tmp_data);
}

/**
 * 返回成功格式的数据
 * @param string $msg
 * @param array $data
 * @param int $code
 * @return \think\response\Json
 */
function success($msg = '', $data = [], $code = 1){
    return return_data($msg, $data, $code);
}

/**
 * 返回失败格式的数据
 * @param string $msg
 * @param array $data
 * @param int $code
 * @return \think\response\Json
 */
function error($msg = '', $data = [], $code = 0){
    return return_data($msg, $data, $code);
}