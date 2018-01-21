<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2017/9/3
 * Time: 18:22
 */

namespace app\dashboard\validate\Manage;

use think\Validate;

class Edit extends Validate
{
    public function __construct(array $rules = [], array $message = [], array $field = [])
    {
        parent::__construct($rules, $message, $field);
    }

    // 规则
    protected $rule = [
        'username'  =>  ['require', 'max:16'],
//        'truename' => [],
        'telphone' => ['number','length:11'],
        'email' => ['email'],
        'auth_group' => ['array'],
//        'status' => ['accepted'],
//        'remarks' => [],
    ];

    // 错误提示
    protected $message  =   [
        'username.require'  =>  '请填写用户名',
        'username.max'      =>  '用户名不能超过16个字符',
        'telphone.number' => '请设置1位的手机号',
        'email.email' => '请设置您的电邮',
        'auth_group.array' => '授权组错误',
        'status.accepted' => '只允许传递1 或 0',
    ];

}