<?php


namespace app\common\model;


use think\Collection;
use think\exception\DbException;
use think\facade\Log;
use think\Model;

class Tags extends Model
{

    const COLOR_LIST = [
        '#4285f4',
        '#ea4335',
        '#fbbc05',
        '#34a853',
        '#0398e8',
        '#da8ef8',
        '#32bea6'
    ];
    public static function getAll()
    {
        try {
            return self::select();
        }catch (DbException $e) {
            Log::error($e -> getTraceAsString());
            return new Collection();
        }
    }

    /**
     * 随机分配一个颜色
     * @param Collection $tags
     */
    public static function randColor(Collection &$tags)
    {
        foreach ($tags as $k => $v) {
            $tags[$k]['border_color'] = self::COLOR_LIST[mt_rand(0,count(self::COLOR_LIST)-1)];
        }
    }

}