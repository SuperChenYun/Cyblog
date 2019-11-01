<?php


namespace app\index\controller;



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

        try {
            $articlesNum = \app\index\model\Article::where($where)->count();
            $articles = \app\index\model\Article::where($where)
                ->cache("article_".sha1($page))
                ->paginate($this->pageRows, $articlesNum);
        } catch (DbException $e) {
            $articles = [];
            \think\facade\Log::error($e->getTraceAsString());
        }
        View::assign('articles', $articles);
        return View::fetch();
    }

    public function show($id)
    {
        return View::fetch();
    }

}