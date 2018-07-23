<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/6/15
 * Time: 23:16
 */

namespace app\common\model;


use think\Model;

class SysGroup extends Model
{
    protected $name = 'sys_group';

    protected $type = [
        'group_actions'    =>  'json',
    ];

}