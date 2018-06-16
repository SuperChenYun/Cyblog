<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/3/20
 * Time: 22:34
 */

namespace app\common\model;


use think\Model;

/**
 * 文章分类相关
 * Class Category
 * @package app\dashboard\model
 */
class Category extends Model
{
    public function getAll()
    {
        return $this->select();
    }

    public function add($postData)
    {
        $data['cat_class_name'] = $postData['cat_class_name'];
        $data['create_at'] = time();
        return $this->insertGetId($data);
    }

    public function edit($data)
    {
        $data['update_at'] = time();
        $state = $this -> update($data);
        if ($state) {
            return true;
        } else {
            return false;
        }
    }

}