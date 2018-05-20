<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/2/19
 * Time: 10:26
 */

namespace app\dashboard\controller;

use think\Db;
use think\Loader;
use think\Request;
use app\dashboard\model\Article as ArticleModel;

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
        $article = Db::name('article') -> where($where) -> order('art_id', 'desc') -> paginate('','', $searchConfig);
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
    public function artEnableOrDisable(Request $request)
    {
        if (Request::instance() -> isAjax()) {
            $article = model('article') -> getByArtId($request -> param('art_id', '0'));
            if ($article -> art_status == ArticleModel::SHOW) {
                $article->art_status = ArticleModel::HIDE;
            } elseif ($article -> art_status == ArticleModel::HIDE) {
                $article -> art_status = ArticleModel::SHOW;
            }
            $state = $article -> save();
            if ($state) {
                return success('操作成功');
            } else {
                return error('操作失败');
            }
        } else {
            return error('Method Error');
        }
    }

    /**
     * 添加文章
     * @param Request $request
     * @return mixed|string|\think\response\Json
     */
    public function artAdd(Request $request)
    {
        if ($request -> isGet()) {
            $category = model('category') -> getAll();
            $this -> assign('category', $category);
            $defaultBannerUrl = model('SysConfig') -> getOne('article_default_banner_url');
            $this -> assign('defaultBannerUrl',$defaultBannerUrl);
            return $this -> fetch();
        } elseif ($request -> isPost()) {
            $validate = Loader::validate('Article.add');
            $result = $validate -> check($request -> post());
            if ($result) {
                $insId = model('article') -> add($request -> post());
                if ($insId) {
                    return success('添加成功',['insId' => $insId]);
                }
            } else {
                return error($validate -> getError());
            }

        } else {
            return '';
        }
    }

    /**
     * 编辑文章
     * @param int $art_id
     * @param Request $request
     * @return mixed|string|\think\response\Json
     */
    public function artEdit(int $art_id, Request $request)
    {
        if ($request -> isGet()) {
            $category = model('category') -> getAll();
            $this -> assign('category', $category);
            $defaultBannerUrl = model('SysConfig') -> getOne('article_default_banner_url');
            $this -> assign('defaultBannerUrl',$defaultBannerUrl);
            $this -> assign('article', model('article') -> getByArtId($art_id));
            return $this -> fetch();
        } elseif ($request -> isPost()) {
            $validate = Loader::validate('Article.edit');
            $result = $validate -> check($request -> param());
            if ($result) {
                $state = model('article') -> edit($request -> param());
                if ($state) {
                    return success('编辑成功');
                }
            } else {
                return error($validate -> getError());
            }
        } else {
            return '';
        }
    }

    /**
     * 删除文章
     * @param int $art_id
     * @return \think\response\Json
     */
    public function artDel(int $art_id)
    {
        $article = model('article') -> getByArtId($art_id);
        $state = $article -> delete();
        if ($state) {
            return success('删除成功');
        } else {
            return error('删除失败');
        }
    }
}