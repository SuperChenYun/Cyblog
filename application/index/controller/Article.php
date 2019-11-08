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

        $articles = \app\index\model\Article::paging($page, $where, 'art_id');
        View::assign('articles', $articles);

        $tags = Tags::getAll();
        Tags::randColor($tags);
        View::assign('tags', $tags);

        return View::fetch();
    }

    /**
     * 查看文章
     * @param $id
     * @return string
     */
    public function show($id)
    {
        $article = \app\index\model\Article::cache('article_'.$id)->getByArtId($id);

        View::assign('article', $article);

        return View::fetch();
    }

}