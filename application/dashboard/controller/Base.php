<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2017/7/30
 * Time: 23:00
 */

namespace app\dashboard\controller;

use app\common\controller\Init;
use app\common\model\SysAction;
use app\common\model\SysGroup;
use app\common\model\SysManage;
use think\facade\Request;

class Base extends Init
{
    // 授权模块 程序填充
    protected $auth_moduel = [];

    // 请求排除的固定url 登录授权除外 需要全部小写 需要人工设置
    protected static $auth_request_url = [
        'index/welcome',
        'index/index',
        'neditor/controller'
    ];

    // 404模板位置view文件夹下
    protected $noAuthPagePath = 'public/404';

    /**
     * @var SysManage
     */
    protected $SysManageModel;

    /**
     * @var SysGroup
     */
    protected $SysGroupModel;

    /**
     * @var SysAction
     */
    protected $SysActionModel;

    /**
     * 初始化控制器
     */
    public function __construct()
    {
        parent::__construct();
        $this -> SysManageModel = model('SysManage');
        $this -> SysGroupModel = model('SysGroup');
        $this -> SysActionModel = model('SysAction');
        $this -> checkLoginInfo();
        //$this -> checkAuthModuleAction();
    }

    /**
     * 兼容空action
     * @param $action_name
     */
//    public function _empty($action_name)
//    {
//        if(Request::isAjax()){
//            return error('Action不存在');
//        }else {
//            return view('public/404');
//        }
//    }

    /**
     * 检测登录状态
     */
    private function checkLoginInfo()
    {
        if (!session('Manage')) {
            if(Request::isAjax()){
                return error('请登录', ['re_url' => url('/')],302);
            }else {
                return $this->redirect('Auth/login');
            }
        }
        $ManageInfo = $this -> SysManageModel -> where(['id' => session('Manage.id')])->find();
        if ($ManageInfo['login_ip'] != $_SERVER['REMOTE_ADDR']) {
            session(null);
            if(Request::isAjax()) {
                return error('ip地址变化,请重新登录', ['re_url' => url('/')], 302);
            }else{
                return $this -> redirect('/');
            }
        }
        if ($ManageInfo -> password != session('Manage')['password']) {
            session(null);
            if(Request::isAjax()) {
                return error('登录失效,请重新登录', ['re_url' => url('/')], 302);
            }else{
                return $this -> redirect('/');
            }
        }
        if ($ManageInfo['change_time'] != session('Manage')['change_time']) {
            session(null);
            if(Request::isAjax()) {
                return error('登录失效,请重新登录', ['re_url' => url('/')], 302);
            }else{
                $this -> redirect('/');
            }
        }
    }

    /**
     * 检测访问权限
     */
    private function checkAuthModuleAction()
    {
        if(session('Manage')['administrator']!== 1)
        $request_url = strtolower( Request::controller() . '/' . Request::action() );
        if(!in_array( $request_url, session('auth_request_url'))){
            if(Request::isAjax()){
                return error('error', '您没有访问权限');
                exit;
            }else {
                echo $this->fetch($this->noAuthPagePath);
                exit;
            }
        }
    }

    /** layuiAdmin **/
    /**
     * 返回菜单信息
     * @return \think\response\Json
     */
    public function menu()
    {
        // 授权组
        if( session('Manage')['administrator'] == 1 ){
            $ManageGroup = $this->SysGroupModel->field('group_actions')->select();
        }else {
            $ManageGroup = $this->SysGroupModel->field('group_actions')->where(['id' => ['in', session('Manage')['auth_group']]])->select();
        }
        // 整理组列表
        $actions = '';
        foreach ($ManageGroup AS $k => $v){
            $actions .= $v['group_actions'] . ',';
        }
        // 整理授权的模块 作为后台左侧菜单
        $auth_module = $this -> SysActionModel -> alias('sa')
            -> join('__SYS_MODULE__ smd', 'smd.id = sa.module_id')
            -> where(['is_menu' => 'y'])
            -> whereIn('sa.id', $actions)
            -> order( 'module_sort asc, action_sort asc')
            -> select();

        // 整理数据为二维数组
        $authArr = [
            [
                'name'  => 'index',
                'title' => '主页',
                'icon'  => 'layui-icon-console',
                'jump'  => '/',
                'list'  =>  []
            ]
        ];
        foreach ($auth_module AS $k => $v){
            $authArr[$v['module_id']]['name'] = $v['module_controller'];
            $authArr[$v['module_id']]['title'] = $v['module_name'];
            $authArr[$v['module_id']]['icon'] = $v['module_iconfount'];
            $authArr[$v['module_id']]['list'][] = [
                'id'    => $v['id'],
                'name' => $v['action'],
                'title' => $v['name'],
                'jump' => url($v['controller'] . '/' . $v['action'], '', '')
            ];
        }
        return success('获取成功', $authArr);
    }

    /**
     * LayuiAdmin Layout 文件
     */
    public function layout()
    {
        return view('/layout');
    }

    /**
     * 选择主题
     * @return \think\response\View
     */
    public function theme()
    {
        return view('/theme');
    }

    /**
     * About
     * @return \think\response\View
     */
    public function about()
    {
        return view('/about');
    }

}