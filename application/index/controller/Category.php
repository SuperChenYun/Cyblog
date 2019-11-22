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
        $categoryes = \app\index\model\Category::paging($page, $where, 'category_id', 'desc', 'categoryes_');
        View::assign('categoryes', $categoryes);
        return View::fetch();
    }

    /**
     * 某个分类下的文章
     */
    public function articles($sign)
    {
        $category = \app\index\model\Category::getByCategorySign($sign);
        if (empty($category)) {
            return View::fetch('/404');
        }
        $where = [
            'art_status' => \app\index\model\Article::SHOW,
            'art_category_id' => $category -> category_id,
        ];
        $articles = \app\index\model\Article::paging($this -> getPageNum(), $where, 'art_id', 'desc', 'category_'.$sign.'_');
        View::assign('articles', $articles);

        $this -> assignAllTags();

        // 用文章的列表
        return View::fetch('article/index');
    }

}