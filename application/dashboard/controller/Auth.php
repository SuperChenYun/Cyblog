<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2017/7/30
 * Time: 22:59
 */
namespace app\dashboard\controller;

use app\common\controller\Init;
use think\Db;
use think\Loader;

class Auth extends Init {
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
    public function login_post()
    {
        $validate = Loader::validate('Manage.login');
        $res = $validate -> check(input('post.'));
        if($res){
            $ManageInfo = $this -> login_man(input('post.username', '', 'trim'), input('post.password', '', 'trim'));
            if($ManageInfo) {
                $this -> login_save_session('Manage',$ManageInfo);
                $this -> login_save_db($ManageInfo);
                 return success('登录成功',  ['re_url' => url('index/index')]);
            }else{
                 return error('登录失败');
            }
        }else{
            return error($validate -> getError());
        }

    }

    /**
     * 数据库信息验证
     * @param string $username 过滤后的用户名
     * @param string $password 过滤后的密码
     * @return array|bool|false|\PDOStatement|string|\think\Model 获取成功返回用户数据 获取失败返回false
     */
    private function login_man($username = '', $password = '')
    {

        $tempInfo = Db::name('sys_manage') -> where(['username' => $username]) -> find();
        $ManageInfo = Db::name('sys_manage') -> where(['username' => $username, 'password' => md5($password . $tempInfo['password_salt'])]) -> find();
        return $ManageInfo ? $ManageInfo : false;

    }

    /**
     * 存储session
     * @param string $key 可自定义 session的key 默认 Manage
     * @param $ManageInfo 要存储的数据
     */
    private function login_save_session($key = 'Manage', $ManageInfo)
    {
       session($key, $ManageInfo);
    }

    /**
     * 记录最近一次登录信息
     * @param $ManageInfo 用户信息
     */
    private function login_save_db($ManageInfo)
    {
        Db::name('sys_manage') -> where(['id' => $ManageInfo['id']])  -> update(['login_ip' => $_SERVER['REMOTE_ADDR'], 'login_time' => time(),'login_number' => ['exp','login_number+1']]);
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