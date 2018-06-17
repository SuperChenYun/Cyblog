<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/5/6
 * Time: 22:30
 */

namespace app\dashboard\validate\System;


use think\Validate;

class Edit extends Validate
{

    // 规则
    protected $rule = [
        's_id'  =>  ['require'],
        'v' => ['require','max:2048'],
    ];

    // 错误提示
    protected $message  =   [
        's_id.require'  =>  's_id错误，请检查代码',
        'v.require' => '请填写参数值的内容',
        'v.max' => '内容最长可设置2048个长度',
    ];

}