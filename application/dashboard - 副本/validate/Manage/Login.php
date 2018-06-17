<?php
/**
 * Created by PhpStorm.
 * User: itzcy
 * Date: 17-8-10
 * Time: 下午10:51
 */

namespace app\dashboard\validate\Manage;

use think\Validate;

class Login extends Validate
{

    // 规则
    protected $rule = [
        'username'  =>  ['require', 'max:16'],
        'password' =>  ['require', 'min:6', 'max:32'],
    ];

    // 错误提示
    protected $message  =   [
        'username.require'  =>  '请填写用户名',
        'username.max'      =>  '用户名不能超过16个字符',
        'password.require'  =>  '请填写您的密码',
        'password.min'      =>  '密码长度需大于6位小于32位',
        'password.max'      =>  '密码长度需大于6位小于32位',
    ];


}