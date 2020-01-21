<?php

namespace app\common\model;

use think\Model;

class Links extends BaseModel
{
    const STATUS_NORMAL = 1; // 正常
    const STATUS_DELETE = 2; // 删除
    const STATUS_APPLY = 0; // 申请中

    public static function allLinks()
    {
        return self::where([
        ])->select();
    }

    public static function normalLinks()
    {
        return self::where([
            'status' => self::STATUS_NORMAL
        ]) -> select();
    }
}