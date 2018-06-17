<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/5/6
 * Time: 22:07
 */

namespace app\dashboard\controller;

use think\Loader;
use think\Request;

class System extends Base
{
    public function base(Request $request)
    {
        if ($request -> isGet()) {
            $baseRows = model('SysConfig') -> getDbAll();
            $this -> assign('baseRows', $baseRows);
            return $this -> fetch();
        } elseif ($request -> isPost()) {

        } else {
            return '';
        }
    }

    public function edit(Request $request, $s_id)
    {
        if ($request -> isGet()) {
            $configRow = model('SysConfig')->getBySId($s_id);
            $this->assign('configRow', $configRow);
            switch ($configRow->type) {
                case 'img':
                    return $this->fetch('edit-' . $configRow->type);
                    break;
                default:
                    return $this->fetch();
            }
        } elseif ($request -> isPost()) {
            $validate = Loader::validate('system.edit');
            $result = $validate -> check($request -> param());
            if ($result) {
                $state = model('SysConfig') -> changeDb($s_id, $request -> param());
                if ($state) {
                    return success('修改成功');
                }
            } else {
                return error($validate -> getError());
            }

        } else {
            return ;
        }
    }

}