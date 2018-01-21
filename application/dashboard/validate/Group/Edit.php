<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/1/21
 * Time: 22:24
 */
namespace app\dashboard\validate\Group;

use think\Validate;

class Edit extends Validate
{
    public function __construct(array $rules = [], array $message = [], array $field = [])
    {
        parent::__construct($rules, $message, $field);
    }

    // 规则
    protected $rule = [
        'group_id'     =>  'require|number',
        'group_actions'     =>  'require|checkGroupActions',
        'group_status'    =>  'require',
    ];

    // 错误提示
    protected $message  =   [
        'group_id.require'  =>  'group_id 不存在',
        'group_status.require'        =>  '请填写组是否启用',
    ];

    protected function checkGroupActions($val)
    {
        if(is_array($val) && isset($val)){
            return true;
        }
        return false;
    }

}