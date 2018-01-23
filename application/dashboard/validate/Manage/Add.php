<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/1/23
 * Time: 21:38
 */

namespace app\dashboard\validate\Manage;

use think\Validate;

class Add extends Validate
{
    // 规则
    protected $rule = [
        'username'  =>  ['require', 'max:16'],
        'truename'  =>  ['require', 'max:12'],
        'telphone'  => ['number','length:11'],
        'password'  =>  ['require', 'min:6', 'max:16'],
        'email'     => ['email'],
        'auth_group' => ['require', 'array'],
        'status'    => ['require']
    ];

    // 错误提示
    protected $message  =   [
        'username.require'  =>  '请填写用户名',
        'username.max'      =>  '用户名不能超过16个字符',
        'truename.require'  =>  '请填写真实姓名',
        'truename.max'      =>  '真实姓名不能超过12个字符',
        'telphone.number' => '请设置11位的手机号',
        'telphone.length' => '请设置11位的手机号',
        'password.require'  =>  '请设置密码',
        'password.min'  =>  '密码必须不少于6位',
        'password.max'  =>  '密码不能超过16位',
        'email.email' => '请设置您的电邮',
        'auth_group.require'    =>  '请选择授权的用户组',
        'auth_group.array' => '授权组错误',
        'status.accepted' => '请选择启用还是禁用',
    ];

}