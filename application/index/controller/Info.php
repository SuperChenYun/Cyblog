<?php


namespace app\index\controller;


use think\facade\View;

/**
 * 关于相关
 * Class Info
 * @package app\index\controller
 */
class Info extends Base
{
    /**
     * @return string
     */
    public function index()
    {
        return View::fetch();
    }

    /**
     * 版权
     */
    public function copyright()
    {

    }


}