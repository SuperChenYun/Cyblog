<?php


namespace app\index\controller;


use think\facade\View;

/**
 * 分类相关处理
 * Class Category
 * @package app\index\controller\
 */
class Category extends Base
{

    /**
     * 非法访问直接重定向
     */
    public function index()
    {
        return View::fetch();
    }

    /**
     * 某个分类下的文章
     */
    public function articles()
    {
        // 用文章的列表
        return View::fetch('article/index');
    }

}