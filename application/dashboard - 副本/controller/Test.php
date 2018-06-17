<?php
/**
 * Created by PhpStorm.
 * User: itzcy
 * Date: 17-8-10
 * Time: 下午2:43
 */
namespace app\dashboard\controller;

use think\Controller;

class Test extends Controller{
    public function index()
    {
        return $this -> fetch('public/404');
    }
}
