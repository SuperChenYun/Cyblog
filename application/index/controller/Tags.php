<?php


namespace app\index\controller;


use app\common\model\Article;
use app\index\model\Tags as TagsModel;
use think\exception\DbException;
use think\facade\View;

/**
 * 分类相关处理
 * Class Category
 * @package app\index\controller\
 */
class Tags extends Base
{

    /**
     * 某个分类下的文章
     */
    public function show($sign)
    {
        $tag = \app\index\model\Tags::getByTagSign($sign);
        if (empty($tag)) {
            return View::fetch('/404');
        }
        $where = [
            'tags_id' => $tag -> id,
        ];
        $articles = \app\index\model\ArticleTags::paging($this -> getPageNum(), $where, 'article_id', 'desc', 'tags_'.$sign.'_', ['normalArticle']);

        View::assign('articles', $articles);

        $this -> assignAllTags();

        // 用文章的列表
        return View::fetch('article/index');
    }

}