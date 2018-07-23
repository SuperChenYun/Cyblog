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
        $itPk = (new self()) -> getItPk($message);
        return $itPk;
    }

    private function getItPk($message)
    {
        $requestUrl = 'http://i.itpk.cn/api.php?question='.$message['Content'].'&api_key=e67b8359f04d016f61f2be1d95ae4f16&api_secret=6l5ee9ona1nx';
        $ch = curl_init($requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}