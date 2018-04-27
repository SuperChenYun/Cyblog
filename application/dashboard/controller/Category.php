<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/4/27
 * Time: 22:00
 */

namespace app\dashboard\controller;


use think\Loader;
use think\Request;

class Category extends Base
{
    public function index()
    {
        $category = model('category') -> where(['status' => 1]) -> paginate();
        $this -> assign('category', $category);
        $this -> assign('totalRows', model('category') -> count());
        $this -> assign('page', $category -> render());
        $this -> assign('pageTotal', $category -> lastPage());
        return $this -> fetch();
    }

    public function cat_add(Request $request)
    {
        if($request -> isGet()) {
            return $this -> fetch();
        } elseif ($request -> isPost()) {
            $result = $this->validate(
                $request -> post(),
                [
                    'cat_class_name'  => 'require|max:25',
                ],
                [
                    'cat_class_name.require' => '请填写分类名称',
                    'cat_class_name.max' => '分类名称最大25个字符'
                ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                return $this->error($result);
            }

                $insId = model('category') -> add($request -> post());
                if ($insId) {
                    return success('添加成功',['insId' => $insId]);
                }

        } else {
            return '';
        }
    }

    public function cat_edit(int $cat_id, Request $request)
    {
        if ($request -> isGet()) {
            $category = model('category') -> getByCatId($cat_id);
            $this -> assign('category', $category);
            return $this -> fetch();
        } elseif ($request -> isPost()) {
            $result = $this->validate(
                $request -> post(),
                [
                    'cat_class_name'  => 'require|max:25',
                ],
                [
                    'cat_class_name.require' => '请填写分类名称',
                    'cat_class_name.max' => '分类名称最大25个字符'
                ]);
            if (true !== $result) {
                return error($result);
            }
            $state = model('category') -> edit($request -> param());
            if ($state) {
                return success('修改成功');
            }
        } else {
            return '';
        }
    }

    public function cat_del(int $cat_id, Request $request)
    {
        $article = model('category') -> getByCatId($cat_id);
        $article -> status = 0;
        $state = $article -> save();
        if ($state) {
            return success('删除成功');
        } else {
            return error('删除失败');
        }
    }
}