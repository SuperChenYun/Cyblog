<?php
/**
 * Created by PhpStorm.
 * User: itzcy
 * Date: 17-8-10
 * Time: 下午10:51
 */

namespace app\dashboard\validate\Manage;

use think\Validate;

class Repass extends Validate
{
    // 规则
    protected $rule = [
        'manage_id'  =>  ['require','number'],
        'password' =>  ['require', 'min:6', 'max:32'],
        'password_confirm' =>  ['require', 'min:6', 'max:32','confirm'],
    ];

    // 错误提示
    protected $message  =   [
        'manage_id.require'  =>  '操作数据不正确',
        'manage_id.number'  =>  '操作数据id不正确',
        'password.require'  =>  '请填写您的密码',
        'password.min'      =>  '密码长度需大于6位小于16位',
        'password.max'      =>  '密码长度需大于6位小于16位',
        'password_confirm.require' => '密码必须！',
        'password_confirm.confirm' => '密码不一致！'
    ];

}