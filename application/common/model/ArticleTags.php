<?php


namespace app\common\model;


use think\exception\DbException;
use think\Model;

class ArticleTags extends BaseModel
{
    public function article()
    {
        return $this -> hasOne('Article', 'article_id', 'art_id');
    }

    /**
     * 正常的文章
     * @return \think\model\relation\HasOne
     */
    public function normalArticle()
    {
        return $this -> hasOne('Article', 'art_id', 'article_id')->bind(\app\index\model\Article::instance()->getTableFields()) -> where([
            'art_status' => Article::SHOW,
        ]) ;
    }


}