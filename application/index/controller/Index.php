<?php

namespace app\index\controller;

use think\facade\View;

class Index extends Base
{


    /**
     * 首页
     *
     * @return string
     */
    public function index()
    {
//        return \view();
	    return View::fetch();
    }
}
