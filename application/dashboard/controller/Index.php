<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2017/7/30
 * Time: 22:53
 */

namespace app\dashboard\controller;

class Index extends Base {

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * 登陆后的框架页
     * @return mixed
     */
    public function index()
    {
        return $this -> fetch();
    }

    /**
     * 欢迎页
     */
    public function welcome()
    {

    }
}