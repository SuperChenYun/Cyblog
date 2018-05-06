<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/5/6
 * Time: 16:14
 */

namespace app\dashboard\model;


use think\Cache;
use think\Model;

class SysConfig extends Model
{
    protected $cacheValue;

    public function __construct($data = [])
    {
        parent::__construct($data);
//        $this -> getCache();
    }

    protected function getCache()
    {
        $this -> cacheValue = Cache::get('sys_config');
        $cacheconfig = [];
        if (empty($this -> cacheValue)) {
            $config = $this -> select();
            foreach ($config as $key => $item) {
                $cacheconfig[$item['k']] = $item['v'];
            }
            Cache::set('sys_config', $cacheconfig);
            $this -> cacheValue = Cache::get('sys_config');
        }
    }

    public function getAll()
    {
        $this -> getCache();
        return $this -> cacheValue;
    }

    public function getDbAll()
    {
        return $this -> select();
    }

    public function getOne($k)
    {
        $this -> getCache();
        return isset($this -> cacheValue[$k]) ? $this -> cacheValue[$k] : '';
    }

    public function change($k, $v)
    {
//        $this -> getCache();
//        $cacheValue = $this -> cacheValue;
//        $cacheValue[$k] = $v;
        $res = $this -> where(['k' => $k]) -> update(['v' => $v, 'update_at' => time()]);
        if ($res) {
//            $state = Cache::set('sys_config', $cacheValue);
            $this -> getCache();
            return $res;
        }
    }

    public function changeDb($id, $data)
    {
        $data['update_at'] = time();
        $res = $this -> where(['s_id' => $id]) -> update($data);
        if ($res) {
            $this -> getCache();
            return $res;
        }
    }

}