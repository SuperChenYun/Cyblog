<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/6/15
 * Time: 22:50
 */

namespace app\dashboard\logic;


class SysManage
{
    protected $SysMangeModel;

    public function __construct()
    {
        $this -> SysMangeModel = model('SysManage');
    }

    /**
     * 数据库信息验证
     * @param string $username 过滤后的用户名
     * @param string $password 过滤后的密码
     * @return array|bool|false|\PDOStatement|string|\think\Model 获取成功返回用户数据 获取失败返回false
     */
    public function loginMan($username = '', $password = '')
    {
        $ManageInfo = $this -> SysMangeModel -> where(['username' => $username]) -> find();
        if ($ManageInfo -> password == md5($password . $ManageInfo -> password_salt)) {
            return $ManageInfo;
        }
        return false;
    }

    /**
     * 记录最近一次登录信息
     * @param $ManageInfo 用户信息
     */
    public function loginSaveDb($ManageInfo)
    {
        $this
            -> SysMangeModel
            -> where([
                'id' => $ManageInfo['id']
            ])
            -> update([
                'login_ip' => $_SERVER['REMOTE_ADDR'],
                'login_time' => time(),
                'login_number' => ['inc','1']
            ]);
    }

}