<?php


namespace app\index\controller;



use app\index\model\Tags;
use think\exception\DbException;
use think\facade\Config;
use think\facade\View;
use think\Log;
use think\paginator\driver\Bootstrap;

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

        $page = $this -> getPageNum();
        $where = [
            ['art_status' ,'=', \app\index\model\Article::SHOW],
            ['art_release_time' ,'<=' , strtotime(date('Y-m-d H:i'))],
        ];

        $articles = \app\index\model\Article::paging($page, $where);
        View::assign('articles', $articles);

        $tags = Tags::getAll();
        Tags::randColor($tags);
        View::assign('tags', $tags);

        return View::fetch();
    }

    public function show($id)
    {
        return View::fetch();
    }

}