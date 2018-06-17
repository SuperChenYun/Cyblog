<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/4/27
 * Time: 22:00
 */

namespace app\dashboard\controller;

use think\facade\Request;

class Category extends Base
{
    public function index()
    {
        $category = model('category') -> where(['status' => 1]) -> paginate();
        $this -> assign('category', $category);
        $this -> assign('totalRows', model('category') -> count());
        $this -> assign('page', $category -> render());
        $this -> assign('pageTotal', $category -> lastPage());
        return view();
    }

    public function catAdd()
    {
        if(Request::isGet()) {
            return view();
        } elseif (Request::isPost()) {
            $result = $this->validate(
                Request::post(),
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

                $insId = model('category') -> add(Request::post());
                if ($insId) {
                    return success('添加成功',['insId' => $insId]);
                }

        } else {
            return '';
        }
    }

    public function catEdit($cat_id)
    {
        if (Request::isGet()) {
            $category = model('category') -> getByCatId($cat_id);
            $this -> assign('category', $category);
            return view();
        } elseif (Request::isPost()) {
            $result = $this->validate(
                Request::post(),
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
            $category = model('category') -> getByCatId(input('cat_id'));
            $state = $category -> save(Request::param());
            if ($state) {
                return success('修改成功');
            }
        } else {
            return '';
        }
    }

    public function catDel($cat_id)
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