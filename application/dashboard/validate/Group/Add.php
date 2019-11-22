<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/1/21
 * Time: 22:24
 */
namespace app\dashboard\validate\Group;

use think\Validate;

class Add extends Validate
{
    // 规则
    protected $rule = [
        'group_actions'     =>  'require|checkGroupActions',
        'group_status'    =>  'require',
        'group_name'    =>  'require',
    ];

    // 错误提示
    protected $message  =   [
        'group_actions.require'     =>  '请选择组的权限',
        'group_status.require'        =>  '请填写组是否启用',
        'group_name.require'    =>  '请设置组名字'
    ];

    protected function checkGroupActions($val)
    {
        if(is_array($val) && isset($val)){
            return true;
        }
        return false;
    }

}