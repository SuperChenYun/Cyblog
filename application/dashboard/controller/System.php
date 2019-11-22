<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/5/6
 * Time: 22:07
 */

namespace app\dashboard\controller;

use think\facade\App;
use think\facade\Request;

class System extends Base
{
    public function base()
    {
        if (Request::isGet()) {
            $baseRows = model('SysConfig') -> getDbAll();
            $this -> assign('baseRows', $baseRows);
            return view();
        } elseif (Request::isPost()) {

        } else {
            return '';
        }
    }

    public function edit($s_id)
    {
        if (Request::isGet()) {
            $configRow = model('SysConfig')->getBySId($s_id);
            $this->assign('configRow', $configRow);
            switch ($configRow->type) {
                case 'img':
                    return view('edit-' . $configRow->type);
                    break;
                default:
                    return view();
            }
        } elseif (Request::isPost()) {
            $validate = App::validate('system.edit');
            $result = $validate -> check(Request::param());
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

    public function add()
    {
        if (Request::isGet()) {
            return view();
        } elseif ( Request::isPost() ) {

        } else {

        }

    }
}