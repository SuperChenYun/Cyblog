<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2017/7/30
 * Time: 23:02
 */
namespace app\common\controller;

/**
 * 整站数据初始化控制器
 * Class Init
 * @package app\common\controller
 */
use think\Controller;

class Init extends Controller {
    /**
     * 初始化控制器
     */
    public function _initialize()
    {
        trace(session(''));
    }
}