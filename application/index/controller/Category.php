<?php


namespace app\index\controller;


use app\index\model\Tags;
use think\exception\DbException;
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
        $page = $this -> getPageNum();
        $where = [
            'status' => \app\index\model\Category::STATUS_NORMAL
        ];
        $categoryes = \app\index\model\Category::paging($page, $where);
        View::assign('categoryes', $categoryes);
        return View::fetch();
    }

    /**
     * 某个分类下的文章
     */
    public function articles($sign)
    {
        $category = \app\index\model\Category::getByCategorySign($sign);
        $where = [
            'art_status' => \app\index\model\Article::SHOW,
            'art_category_id' => $category -> id,
        ];
        $articles = \app\index\model\Article::paging($this -> getPageNum(), $where, 'art_id');
        View::assign('articles', $articles);

        $tags = Tags::getAll();
        Tags::randColor($tags);
        View::assign('tags', $tags);
        
        // 用文章的列表
        return View::fetch('article/index');
    }

}