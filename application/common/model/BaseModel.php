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
            $tagsNum = self::where($where)->count();
            $tags = self::where($where);
            if (!empty($with)) $tags -> with($with);
            $tags -> order($orderFile, $sort);
            $tags -> cache($cachePrefix.sha1($page));

            return $tags -> paginate(null, $tagsNum);
        } catch (DbException $e) {
            \think\facade\Log::error($e->getTraceAsString());
            return  [];
        }
    }
}