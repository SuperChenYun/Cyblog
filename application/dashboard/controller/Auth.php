<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2017/7/30
 * Time: 22:59
 */
namespace app\dashboard\controller;

use app\common\controller\Init;
use think\facade\App;

class Auth extends Init {

    protected $SysGroupModel;

    protected $SysActionModel;

    /**
     * 初始化控制器
     */
    public function __construct()
    {
        parent::__construct();
        $this -> SysGroupModel = model('SysGroup');
        $this -> SysActionModel = model('SysAction');
    }

    /**
     * 登入
     */
    public function login()
    {
        return $this -> fetch();
    }

    /**
     * 登录实际数据校验
     */
    public function loginPost()
    {
        $validate = App::validate('Manage.login');
        $res = $validate -> check(input('post.'));
        if($res){
            $SysManageLogic = model('SysManage', 'logic');
            $manageInfo = $SysManageLogic
                -> loginMan(input('post.username', '', 'trim'), input('post.password', '', 'trim'));
            if($manageInfo) {
                $this -> loginSaveSession('Manage',$manageInfo);
                $SysManageLogic -> loginSaveDb($manageInfo);
                 return success('登录成功',  ['re_url' => url('index/index')]);
            }else{
                 return error('登录失败');
            }
        }else{
            return error($validate -> getError());
        }
    }

    /**
     * 存储session
     * @param string $key 可自定义 session的key 默认 Manage
     * @param $ManageInfo 要存储的数据
     */
    private function loginSaveSession($key = 'Manage', $ManageInfo)
    {
       session($key, $ManageInfo);
    }
    
    /**
     * 登出
     */
    public function logout()
    {
        session('Manage', null);
        session('auth_module', null);
        $this -> redirect('/dashboard');
    }

}