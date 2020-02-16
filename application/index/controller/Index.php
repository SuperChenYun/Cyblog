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
        View::assign('title', '欢迎访问我的博客');
	    return View::fetch();
    }
}
