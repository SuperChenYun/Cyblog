<?php


namespace app\index\controller;



use think\facade\View;

/**
 * 文章处理
 * Class Article
 * @package app\index\controller
 */
class Article extends Base
{

    /**
     * 全部文章列表
     * @url /articles
     * @return String
     */
    public function index()
    {
        return View::fetch();
    }

    public function show($id)
    {
        return View::fetch();
    }

}