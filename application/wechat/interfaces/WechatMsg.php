<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/4/14
 * Time: 9:34
 */

namespace app\wechat\interfaces;

interface WechatMsg
{
    public static function deal($message);
}