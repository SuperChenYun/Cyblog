<?php


namespace app\common\model;


use think\exception\DbException;
use think\Model;

class BaseModel extends Model
{
    protected static $instanceMap = [];

    public static function instance($newInstance = false)
    {
        if ($newInstance) {
            return new static();
        }

        if (!isset(self::$instanceMap[static::class])) {
            self::$instanceMap[static::class] = new static();
        }
        return self::$instanceMap[static::class];
    }

    /**
     * 分页获取
     * @param $page
     * @param array $where
     * @return array|\think\Paginator
     */
    public static function paging($page, $where = [], $orderFile = 'id', $sort = 'desc', $cachePrefix ='', $with = []) {
        try {
            $num = self::where($where)->count();
            $model = self::where($where);
            if (!empty($with)) $model -> with($with);
            $model -> order($orderFile, $sort);
            $model -> cache($cachePrefix.sha1($page), 1800);

            return $model -> paginate(null, $num);
        } catch (DbException $e) {
            \think\facade\Log::error($e->getTraceAsString());
            return  [];
        }
    }
}