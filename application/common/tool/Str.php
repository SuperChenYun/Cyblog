<?php


namespace app\common\tool;


abstract class Str
{

    public static function cut(string $string ,int $start = 0, int $length = 140, $codeType = 'UTF-8')
    {
        if (mb_strlen($string) > $length) {
            return mb_strcut($string, $start, $length, $codeType) . '...';
        }
        return mb_strcut($string, $start, $length);
    }
}