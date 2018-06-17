<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2017/7/30
 * Time: 23:00
 */

namespace app\dashboard\controller;

use app\common\controller\Init;
use think\facade\Config;
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

    protected $SysManageModel;
    protected $SysGroupModel;
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
        $this -> cacheAuth();
        //$this -> checkAuth_ModuleAction();
        $this -> assignAuthModuleAndManage();
    }

    /**
     * 兼容空action
     * @param $action_name
     */
    public function _empty($action_name)
    {
        if(Request::isAjax()){
            return error('Action不存在');
        }else {
            return $this->fetch('public/404');
        }
    }

    /**
     * 初始化常量 配置 兼容Tp3 按需调用
     */
    private function sysinit()
    {
        define('MODULE_NAME', Request::module());
        define('CONTROLLER_NAME', Request::controller());
        define('ACTION_NAME', Request::action());
    }

    /**
     * 检测登录状态
     */
    private function checkLoginInfo()
    {
        if (!session('Manage')) {
            if(Request::isAjax()){
                return error('请登录', ['re_url' => url('/')],302);
            }else {
                $this->redirect('Auth/login');
            }
        }
        $ManageInfo = $this -> SysManageModel -> where(['id' => session('Manage.id')])->find();
        if ($ManageInfo['login_ip'] != $_SERVER['REMOTE_ADDR']) {
            session(null);
            if(Request::isAjax()) {
                return error('ip地址变化,请重新登录', ['re_url' => url('/')], 302);
            }else{
                $this -> redirect('/');
            }
        }
        if ($ManageInfo -> password != session('Manage')['password']) {
            session(null);
            if(Request::isAjax()) {
                return error('登录失效,请重新登录', ['re_url' => url('/')], 302);
            }else{
                $this -> redirect('/');
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
     * 检查模块授权信息并存储session
     */
    private function cacheAuth()
    {
        // 是否是调试模式
        if(Config::get('app_debug')){
            $this -> flushAuthCache();
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

    /**
     * 分配授权信息
     */
    private function assignAuthModuleAndManage(){
        $this -> assign('Manage', session('Manage'));
        $this -> assign('auth_module', session('auth_module'));
    }

    public function flushAuthCache()
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
        $authArr = [];
        foreach ($auth_module AS $k => $v){
            $authArr[ $v['module_id'] ]['module_id']= $v['module_id'];
            $authArr[ $v['module_id'] ]['module_name'] = $v['module_name'];
            $authArr[ $v['module_id'] ]['module_controller'] = $v['module_controller'];
            $authArr[ $v['module_id'] ]['module_iconfount'] = $v['module_iconfount'];
            $authArr[ $v['module_id'] ]['actions'][] = $v;
        }

        // 整理授权访问的模块
        $auth_request_url = self::$auth_request_url;
        foreach($authArr AS $amk => $amv){
            foreach ($amv['actions'] AS $ak => $av){
                $auth_request_url[]  = strtolower($av['controller']) . '/' . strtolower($av['action']);
            }
        }
        session('auth_request_url', $auth_request_url);
        session('auth_module', $authArr);
    }

}