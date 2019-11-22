<?php 
namespace app\common\model;

use think\Model;

class SysManage extends BaseModel
{
    protected $name = 'sys_manage';

    protected $type = [
        'auth_group'    =>  'json',
    ];


}