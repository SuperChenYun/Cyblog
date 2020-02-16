<?php


namespace app\index\controller;


use think\facade\Response;
use think\facade\View;

/**
 * 关于相关
 * Class Info
 * @package app\index\controller
 */
class Info extends Base
{
    public function index()
    {
        View::assign('title', 'Redirect');
        return Response::create('/', 'redirect', '302');
    }
    /**
     * @return string
     */
    public function about()
    {
        View::assign('title', 'About');
        return View::fetch();
    }

    /**
     * 版权
     */
    public function copyright()
    {
        View::assign('title', 'Copyright');
        return View::fetch();
    }


}