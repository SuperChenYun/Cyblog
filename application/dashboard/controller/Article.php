<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/2/19
 * Time: 10:26
 */

namespace app\dashboard\controller;

use think\Db;
use think\Request;
use think\Response;

class Article extends Base
{
    /**
     * 列表页
     * @return mixed
     */
    public function index ()
    {
        $searchConfig = [
            'query' => ['search' => input('get.search', '', 'trim')]
        ];
        $where = [];
        $article = Db::name('article') -> where($where) -> order('art_id', 'asc') -> paginate('','', $searchConfig);
        $this -> assign('article', $article);
        $this -> assign('totalRows', Db::name('article') -> count());
        $this -> assign('page', $article -> render());
        $this -> assign('pageTotal', $article -> lastPage());
        return $this -> fetch();
    }

    /**
     * 文章展示或者隐藏
     * @return \think\response\Json
     */
    public function art_enable_or_disable()
    {
        if (Request::instance() -> isAjax()) {
            $article = Db::name('article') -> getByArtId(input('get.art_id',0,'intval'));
            dump($article);
        } else {
            return error('Method Error');
        }
    }

    public function art_add(Request $request)
    {
        if ($request -> isGet()) {
            return $this -> fetch();
        } elseif ($request -> isPost()) {

        } else {
            return '';
        }
    }
}