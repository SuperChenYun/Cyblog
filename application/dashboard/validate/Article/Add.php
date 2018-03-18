<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/3/18
 * Time: 16:31
 */

namespace app\dashboard\validate\Article;


use think\Validate;

class Add extends Validate
{
    // 规则
    protected $rule = [
        'art_title'     =>  'require|min:1',
    ];

    // 错误提示
    protected $message  =   [
        'art_title.require'  =>  '必须填写标题',
        'art_title.min'  =>  '必须填写标题',
    ];
}