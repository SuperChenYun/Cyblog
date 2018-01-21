<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/1/21
 * Time: 22:24
 */
namespace app\dashboard\validate\Auth;

use think\Validate;

class Edit extends Validate
{
    public function __construct(array $rules = [], array $message = [], array $field = [])
    {
        parent::__construct($rules, $message, $field);
    }

    // 规则
    protected $rule = [
        'action_id'     =>  ['require', 'number'],
        'controller'    =>  ['require'],
        'action'        =>  ['require'],
        'module_id'     =>  ['require', 'number'],
        'is_menu'       =>  ['require']
    ];

    // 错误提示
    protected $message  =   [
        'action_id.require'  =>  'action_id 不存在',
        'controller.require'        =>  '请填写controller',
        'action.require'        =>  '请填写 action',
        'module_id.require'     =>  '请选择隶属的模块',
        'is_menu.require'       =>  '请选择是否显示到菜单'
    ];

}