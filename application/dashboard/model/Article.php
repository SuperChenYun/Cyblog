<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/3/18
 * Time: 16:40
 */

namespace app\dashboard\model;

use think\Model;
use think\Request;

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
        $this -> setAttr('art_create_at', time());
        $this -> setAttr('art_update_at', time());
        $this -> setAttr('art_author_id', $this -> getArtAutherId());
        $this -> setAttr('art_author_name', $this -> getArtAutherName());
        $this -> setAttr('art_class_id', $this -> getArtClassId());
        $this -> setAttr('art_class_name', $this -> getArtClassName());
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
        $this -> setAttr('art_update_at', time());
        //$this -> setAttr('art_author_id', $this -> getArtAutherId());
        //$this -> setAttr('art_author_name', $this -> getArtAutherName());
        $this -> setAttr('art_class_id', $this -> getArtClassId());
        $this -> setAttr('art_class_name', $this -> getArtClassName());
        $state = $this -> update($data);
        if ($state) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取当前作者的id
     * @return int
     */
    protected function getArtAutherId()
    {
        return session('Manage.id') ?: false;
    }

    /**
     * 获取当前作者的 用户名
     * @return bool
     */
    protected function getArtAutherName()
    {
        return session('Manage.username') ?: false;
    }

    /**
     * 获取当前文章分类Id
     * @return int
     */
    protected function getArtClassId()
    {
        return Request::instance() -> post('art_class_id') ?: 0;
    }

    /**
     * 获取当前文章所在的分类名称
     * @return string
     */
    protected function getArtClassName()
    {
        if ($this -> getAttr('art_class_id') == 0) {
            return 'not class';
        }
        $res = $this -> hasOne('Category','art_class_id','cat_id') ->field('cat_class_name') -> find();
        return $res -> cat_class_name ?: '';
    }

}