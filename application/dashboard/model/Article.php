<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/3/18
 * Time: 16:40
 */

namespace app\dashboard\model;

use think\Model;

class Article extends Model
{
    public function add($data)
    {
        $data['art_create_at'] = time();
        $state =$this -> insert($data);
        if ($state) {
            return $this -> getLastInsID();
        } else {
            return false;
        }
    }

}