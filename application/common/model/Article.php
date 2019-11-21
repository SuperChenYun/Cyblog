<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/3/18
 * Time: 16:40
 */

namespace app\common\model;

use think\exception\DbException;
use think\Model;
use think\facade\Request;

/**
 * 文章相关
 * Class Article
 * @package app\dashboard\model
 */
class Article extends Model
{
    const SHOW = 1;
    const HIDE = 2;

    public function add($data)
    {
        $this -> data($data);
        $this -> setAttr('art_desc', $this -> getArtDesc());
        $this -> setAttr('art_create_at', time());
        $this -> setAttr('art_update_at', time());
        $this -> setAttr('art_category_id', $this -> getArtCategoryId());
        $this -> setAttr('art_category_name', $this -> getArtCategoryName());
        $this -> setAttr('art_banner_url', $this -> getArtBannerUrl());
        $state = $this -> save($data);
        if ($state) {
            return $this -> getLastInsID();
        } else {
            return false;
        }
    }

    /**
     * 修改文章
     * @param $data
     * @return bool
     */
    public function edit($data)
    {
        $this -> data($data);
        $data['art_desc'] = $this -> getArtDesc();
        $data['art_update_at'] =  time();
        $data['art_update_at'] =  time();
        $data['art_category_id'] =  $this -> getArtCategoryId();
        $data['art_category_name'] =  $this -> getArtCategoryName();
        $data['art_banner_url'] = $this -> getArtBannerUrl();
        $state = $this -> save($data);
        if ($state) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 分页获取
     * @param $page
     * @param array $where
     * @return array|\think\Paginator
     */
    public static function paging($page, $where = [], $orderFile = null, $sort = 'desc', $cachePrefix= "articles_") {
        try {
            $articlesNum = self::where($where)->count();
            $article = self::where($where);
            $article -> order($orderFile, $sort);
            $article ->cache($cachePrefix.sha1($page));

            return $article ->paginate(null, $articlesNum);
        } catch (DbException $e) {
            \think\facade\Log::error($e->getTraceAsString());
            return  [];
        }
    }

    /**
     * 获取当前文章分类Id
     * @return int
     */
    protected function getArtCategoryId()
    {
        return Request::post('art_category_id') ?: 0;
    }

    /**
     * 获取当前文章所在的分类名称
     * @return string
     */
    protected function getArtCategoryName()
    {
        if ($this -> getAttr('art_category_id') == 0) {
            return '未分类';
        }
        try {
            $res = \model('Category')
                ->field('category_name')
                ->where(['category_id' => $this->getArtCategoryId()])
                ->find();
            return $res->category_name ?: '';
        } catch (DbException $e) {
            trace($e -> getTraceAsString(), 'ERROR');
            return '';
        }
    }

    /**
     * 获取文章的banner 图url
     * @return mixed|string
     */
    private function getArtBannerUrl()
    {
        if (empty($this -> getAttr('art_banner_url'))) {
            $defaultBannerUrl = \model('SysConfig') -> getOne('article_default_banner_url');
            return !empty($defaultBannerUrl) ? $defaultBannerUrl : '';
        }
        return $this -> getAttr('art_banner_url');
    }

    /**
     * 获取文章的简短描述
     * @return string
     */
    private function getArtDesc()
    {
        if ($this -> getAttr('art_desc')) {
            return $this -> getAttr('art_desc');
        }
        $str = $this -> getAttr('art_content_text');
        $start=0;
        $length= 140;
        $encoding = 'utf-8';
        return mb_substr($str, $start, $length, $encoding);
    }

}