<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/4/14
 * Time: 9:32
 */

namespace app\wechat\wechatmsg;


use app\wechat\interfaces\WechatMsg;

class Text implements WechatMsg
{
    public static function deal($message)
    {
        // TODO: Implement deal() method.
        return 'This is Text Deal Process';
    }

}