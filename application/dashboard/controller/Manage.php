<?php
/**
 * Created by PhpStorm.
 * User: itzcy
 * Date: 17-8-13
 * Time: 上午11:08
 */
namespace app\dashboard\controller;

use app\common\model\SysGroup;
use app\common\model\SysManage;
use think\facade\App;
use think\facade\Request;

class Manage extends Base
{

    /****************************** 展示 ******************************/
    /**
     * 用户列表
     */
    public function manageList()
    {
        $searchUserOrEmailOrPhone = input('get.search', '', 'trim');
        $searchConfig = [
            'query' => ['search' => $searchUserOrEmailOrPhone]
        ];

        $where = [
//            'truename|telphone|email' => ['like' , "$searchUserOrEmailOrPhone%"]
        ];

        $manage = model('sysManage') -> where($where) -> order('id', 'asc') -> paginate('','', $searchConfig);
        $group = model('sysGroup') -> select();

        $manageRowsGroupList = [];
        foreach ($manage -> items()  AS $key => $val) {
            if($val['auth_group']){
                $authGroupArr = $val['auth_group'];
                $manageRowsGroupList[$key] = $val -> toArray();
                foreach ($group AS $k => $v){
                    if( in_array($v['id'], $authGroupArr) ){
                        $manageRowsGroupList[$key]['auth_group_name'][] = $v['group_name'];
                    }
                }
            }
        }
        $this -> assign('ManageRows', $manageRowsGroupList);
        $this -> assign('manageTotalRow', $manage -> total());
        $this -> assign('page', $manage -> render());
        $this -> assign('pageTotal', $manage -> lastPage());
        return view();
    }

    /**
     * 用户组列表
     */
    public function groupList()
    {
        $groupTotalRows = model('sysGroup') -> count();
        $groupRows = model('sysGroup') -> paginate();
        $actionRows = model('sysAction') -> select();

        $groupRowsArr = []; // 处理后的数组
        foreach ($groupRows -> items() AS $key => $val){
            $actionsArr = $val['group_actions'];
            $groupRowsArr[$key] = $val -> toArray();
            foreach ($actionRows AS $k => $v){
                if(in_array($v['id'], $actionsArr)){
                    $groupRowsArr[$key]['group_actions_name'][] = $v['name'];
                }
            }
        }

        $this -> assign('groupTotalRows', $groupTotalRows);
        $this -> assign('groupRows', $groupRowsArr);
        $this -> assign('page', $groupRows -> render());
        $this -> assign('pageTotal', $groupRows -> lastPage());
        return view();
    }

    /**
     * 权限列表
     */
    public function authList()
    {
        $actionTotalRows = model('sys_action') -> count();
        $actionRows = model('sys_action') -> alias('sa') -> join('__SYS_MODULE__ sm', 'sm.id = sa.module_id') -> field(['sa.id' => 'said','sm.id' => 'smid','sa.*','sm.*']) -> paginate();

        $this -> assign('actionTotalRows', $actionTotalRows);
        $this -> assign('actionRows', $actionRows -> items());
        $this -> assign('page', $actionRows -> render());
        $this -> assign('pageTotal', $actionRows -> lastPage());
        $this -> assign('actionTotalRows', $actionTotalRows);
        return view();
    }

    /****************************** 添加 ******************************/

    /**
     * 添加auth
     */
    public function authAdd()
    {
        if(Request::isGet()){
            $this -> assign('moduleRows', model('sysModule') -> where([]) -> select());
            return view();
        }else if(Request::isPost()){
            $validate = App::validate('Auth.add');
            $result = $validate -> check($_POST);
            if ($result) {
                $data['name'] = input('post.name', '', 'trim');
                $data['controller'] = input('post.controller', '', 'trim');
                $data['action'] = input('post.action', '', 'trim');
                $data['action_sort'] = input('post.action_sort',0,'trim');
                $data['module_id'] = input('post.module_id', '', 'trim');
                $data['is_menu'] = input('post.is_menu', '', 'trim');
                if( model('sys_action') -> insert($data) ){
                    return success('添加成功', ['url'   =>  url('auth_list')]);
                }else{
                    return error('添加失败');
                }
            } else {
                return error($validate -> getError());
            }
            // post提交过来数据
        }else{
            return error('请求类型错误 只允许get post 请求');
        }
    }

    public function manageAdd()
    {
        if (Request::isGet()) {
            $this -> assign('group_list', model('sys_group')-> select());
            return view();
        }else{
            $validate = App::validate('Manage.add');
            $result = $validate -> check($_POST);
            if($result){
                $data = new SysManage();
                $data['username'] = input('post.username', '', 'trim');
                $data['truename'] = input('post.truename', '', 'trim');
                $data['telphone'] = input('post.telphone', '', 'trim');
                $data['password_salt'] = mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9);
                $data['password'] = md5(input('post.password', '', 'trim') . $data['password_salt']);
                $data['email'] = input('post.email', '', 'trim');
                $data['auth_group'] = $_POST['auth_group'];
                $data['status'] = input('post.status', '', 'trim');
                $data['remarks'] = input('post.remarks', '', 'trim');
                if( $data -> save() ){
                    return success('添加成功', ['url' => url('manage_list')]);
                }else{
                    return error('添加失败');
                }
            }else{
                return error($validate -> getError());
            }
        }

    }

    public function groupAdd()
    {
        if (Request::isGet()) {
            $this -> assign('actionRows', model('sys_action') -> where([]) -> select());
            return view();
        }else{
            $validate = App::validate('Group.add');
            $result = $validate -> check($_POST);
            if ($result) {
                $data = new SysGroup();
                $data['group_name'] = input('post.group_name', '', 'trim');
                $data['group_actions'] = is_array($_POST['group_actions']) ? $_POST['group_actions'] : [];
                $data['group_status'] = input('post.group_status', 1, 'intval');
                $data['group_remarks'] = input('post.group_remarks', 'htmlspecialchars');
                if ( $data -> save()) {
                    return success('添加成功', ['url' => url('group_list')]);
                } else {
                    return error('添加失败');
                }
            } else {
                return error($validate -> getError());
            }
        }

    }

    /****************************** 编辑 ******************************/

    /**
     * 编辑用户信息
     */
    public function manageEdit()
    {
        if( Request::isGet() ){
            $this -> assign('group_list', model('sys_group') -> select());
            $this -> assign('manage_info', model('sys_manage') -> where(['id' => input('get.manage_id', 0 , 'intval')]) -> find() );
            return view();
        }elseif( Request::isPost() ) {
            $validate = App::validate('Manage.edit');
            $result = $validate -> check($_POST);
            if($result){
                $data = model('sysManage') -> getById(input('post.manage_id'));
                $data['username'] = input('post.username', '', 'trim');
                $data['truename'] = input('post.truename', '', 'trim');
                $data['telphone'] = input('post.telphone', '', 'trim');
                $data['email'] = input('post.email', '', 'trim');
                $data['auth_group'] = $_POST['auth_group'];
                $data['status'] = input('post.status', '', 'trim');
                $data['remarks'] = input('post.remarks', '', 'trim');
                if( $data -> save() ){
                    return success('修改成功');
                }else{
                    return error('修改失败');
                }
            }else{
                return error($validate -> getError());
            }
        }else{
            return error( '操作方式有误');
        }
    }

    /**
     * 编辑组
     * @return mixed|\think\response\Json
     */
    public function groupEdit()
    {
        if( Request::isGet() ){
            $actionRows = model('sys_action') -> where([]) -> select();
            $groupInfo = model('sys_group') -> where(['id' => input('get.group_id', 0 , 'intval')]) -> find();
            $this -> assign('actionRows', $actionRows);
            $this -> assign('group_info', $groupInfo);
            return view();
        }elseif( Request::isPost() ) {
            $validate = App::validate('Group.edit');
            if (input('group_id', 0 , 'intval') == 1) {
                return error('禁止操作');
            }
            $result = $validate -> check($_POST);
            if($result){
                $data = model('sys_group') -> getById(input('group_id', 0 , 'intval'));
                $data['group_name'] = input('post.group_name', '', 'trim');
                $data['group_actions'] = is_array($_POST['group_actions']) ? $_POST['group_actions'] : [];
                $data['group_status'] = input('post.group_status', 1, 'intval');
                $data['group_remarks'] = input('post.group_remarks', 'htmlspecialchars');
                if( $data -> save() ){
                    return success('修改成功');
                }else{
                    return error('修改失败');
                }
            }else{
                return error($validate -> getError());
            }
        }else{
            return error( '操作方式有误');
        }
    }

    /**
     * 编辑权限信息
     *
     * @return mixed|\think\response\Json
     */
    public function authEdit(){
        if( Request::isGet() ){
            $this -> assign('moduleRows', model('sys_module') -> where([]) -> select());
            $this -> assign('action_info', model('sys_action') -> where(['id' => input('get.auth_id', 0 , 'intval')]) -> find() );
            return view();
        }elseif( Request::isPost() ) {
            $validate = App::validate('Auth.edit');
            $result = $validate -> check($_POST);

            if($result){
                $data['name'] = input('post.name', '', 'trim');
                $data['controller'] = input('post.controller', '', 'trim');
                $data['action'] = input('post.action', '', 'trim');
                $data['action_sort'] = input('post.action_sort',0,'trim');
                $data['module_id'] = input('post.module_id', '', 'trim');
                $data['is_menu'] = input('post.is_menu', '', 'trim');
                if( model('SysAction') -> where(['id' => input('post.action_id')]) -> update($data) ){
                    return success('修改成功', ['url'   => url('auth_list')]);
                }else{
                    return error('修改失败');
                }
            }else{
                return error($validate -> getError());
            }
        }else{
            return error( '操作方式有误');
        }
    }

    /****************************** 操作 ******************************/

    /**
     * 启用停用
     */
    public function manageEnableOrDisable()
    {
        if( Request::isGet() ){

        }elseif( Request::isPost() ) {

            $m_id = input('post.m_id', 0, 'intval');
            if ($m_id == 1) {
                return error('禁止操作');
            }
            $m_info = model('sys_manage')->getById($m_id);
            if($m_info['administrator'] == 1){
                return error('不允许对超级管理员进行操作');
                exit;
            }

            if ($m_info['status'] == 0) {
                // 启用
                $response = model('sys_manage')->where(['id' => $m_info['id']])->setField('status', 1);
            } elseif ($m_info['status'] == 1){
                // 禁用
                $response = model('sys_manage')->where(['id' => $m_info['id']])->setField('status', 0);
            }
            if($response){
                return success('操作成功');
            }else{
                return error('操作失败');
            }

        }else{
            return error('操作方式有误');
        }
    }

    /**
     * 重置密码
     */
    public function manageRepass()
    {
        if( Request::isGet() ){
            $m_id = input('get.id', 0 ,'intval');
            $manage_info = model('sys_manage') -> getById($m_id);
            $this -> assign('manage_info', $manage_info);
            return view();
        }elseif( Request::isPost() ) {
            $id = input('post.manage_id', 0 ,'intval');
            $validate = App::validate('Manage.repass');
            $result = $validate -> check($_POST);
            if(true === $result){
                $data['password_salt'] = mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
                $data['password'] = md5( input('post.password') . $data['password_salt'] ) ;
                $result = model('sys_manage') -> where(['id' => $id]) -> update($data);
                if($result){
                    return success('修改成功');
                }else{
                    return error('修改失败');
                }
            }else{
                return error($validate -> getError());
            }

        }else{
            return error('操作方式有误');
        }
    }

    /**
     * 删除
     */
    public function manageDel()
    {
        if( Request::isGet() ){

        }elseif( Request::isPost() ) {
            $m_id = input('post.m_id', 0, 'intval');
            if($m_id == 0){
                return success('操作失败！');
                exit;
            }
            $data = model('SysManage') -> getById($m_id);
            if ( $data -> delete() ){
                return success('删除成功，数据不可恢复!');
            }else{
                return success( '删除失败！');
            }
        }else{
            return success('操作方式有误');
        }
    }

    /**
     * 组 启用 停用
     *
     * @return \think\response\Json
     */
    public function groupEnableOrDisable()
    {
        $g_id = input('post.g_id','','trim');
        if(empty($g_id)){
            return error('参数错误');
            exit;
        }
        if ($g_id == 1) {
            return error('禁止操作');
        }

        $g_info = model('sys_group') -> getById($g_id);
        if($g_info['group_status'] == 1){
            $field['group_status'] = 0;
        }elseif ($g_info['group_status'] == 0){
            $field['group_status'] = 1;
        }else{
            $field['group_status'] = 0;
        }

         if( model('sys_group') -> where(['id' => $g_id]) -> update($field) ){
            return success('操作成功');
         }else{
             return error('操作失败');
         }

    }

    public function groupDel()
    {
        if (Request::isAjax() && Request::isPost()) {
            $g_id = input('post.g_id', 0, 'intval');
            $data = model('sysGroup') -> getById($g_id);
            if ($data -> delete()) {
                return success('删除成功');
            }else{
                return error('删除失败');
            }
        }

    }
}