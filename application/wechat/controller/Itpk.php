<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/6/7
 * Time: 22:31
 */

namespace app\wechat\controller;


use think\Controller;

class Itpk extends Controller
{
    public function index()
    {
        $ch = curl_init('http://i.itpk.cn/api.php?question=%E7%AC%91%E8%AF%9D');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        return json(json_decode(curl_exec($ch)));
    }

}