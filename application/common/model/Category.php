<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/3/20
 * Time: 22:34
 */

namespace app\common\model;


use think\exception\DbException;
use think\facade\Log;
use think\Model;

/**
 * 文章分类相关
 * Class Category
 * @package app\dashboard\model
 */
class Category extends Model
{

    const STATUS_NORMAL = 1;
    const STATUS_DELETE = 2;

    /**
     * 获取全部
     */
    public function getAll()
    {
        try {
            return $this->select();
        } catch (DbException $e) {
            Log::error($e->getTraceAsString());
            return [];
        }
    }

    /**
     * 带分页获取
     * @param $page
     * @return array|\think\Paginator
     */
    public static function paging($page, $where = [])
    {
        try {
            $articlesNum = self::count();
            return $categoryes = self::where($where)
                ->cache("categoryes_" . sha1($page))
                ->paginate(null, $articlesNum);
        } catch (DbException $e ) {
            \think\facade\Log::error($e->getTraceAsString());
            return [];
        }
    }

    /**
     * @param $postData
     * @return int|string
     */
    public function add($postData)
    {
        $data['category_name'] = $postData['category_name'];
        $data['create_at'] = time();
        return $this->insertGetId($data);
    }

    /**
     * @param $data
     * @return bool
     */
    public function edit($data)
    {
        $data['update_at'] = time();
        $state = $this -> update($data);
        if ($state) {
            return true;
        } else {
            return false;
        }
    }

}