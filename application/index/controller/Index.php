<?php

namespace app\index\controller;

use app\index\model\Links;
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
        $links = Links::normalLinks();
        View::assign('links', $links);
	    return View::fetch();
    }
}
