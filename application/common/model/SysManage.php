<?php 
namespace app\common\model;

use think\Model;

class SysManage extends Model 
{
    protected $name = 'sys_manage';

    protected $type = [
        'auth_group'    =>  'json',
    ];


}