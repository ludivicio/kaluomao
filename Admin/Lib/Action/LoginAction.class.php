<?php

/**
 *
 */
class LoginAction extends Action {

    public function index() {
        $this->display();
    }

    // 登陆处理流程
    public function login() {
        if (!IS_POST) {
            halt('页面不存在');
        }

        // 获取提交的数据
        $account = $this->_post('account');
        // 密码采用md5加密
        $password = $this->_post('password', 'md5');

        
        /*
        
        $data = array(
            'account' => $account,
            'password' => $password,
            'role_id' => 1,
            'last_ip' => get_client_ip(),
            'last_time' => time(),
            'status' => 1,
            'email' => 'lurma@qq.com',
        );

        M('admin')->add($data);

        */

        $db = M('admin');
        $where = array('account' => $account, 'status' => 1);

        $admin = $db->where($where)->find();

        if (!$admin || $admin['password'] != $password) {
            $this->error('用户名或密码错误！');
        }

        // {不可用:0, 可用:1}
        if (!$admin['status']) {
            $this->error('用户被锁定！');
        }

        // 从角色表中获取当前用户的角色
        $role_name = M('adminRole')->where(array('id' => $admin['role_id']))->getField('name');

        /*
        $session = array(
            'uid' => $admin['id'],
            'account' => $admin['account'],
            'role_id' => $admin['role_id'],
            'role_name' => $role_name,
        );
        */

        // 保存cookie，时效为10天
        // cookie('admin', $session, array('expire' => 3600*24*10));
        // 保存session
        session('uid', $admin['id']);
        session('account', $admin['account']);
        session('role_id', $admin['role_id']);
        session('role_name', $role_name);

        $data = array(
            'id' => $admin['id'],
            'last_time' => time(),
            'last_ip' => get_client_ip()
        );

        $db->save($data);

        $this->success('登陆成功', U('Index/index'));
    }

    // 注销处理流程
    public function logout() {
        session('uid', null);
        session('account', null);
        session('role_id', null);
        session('role_name', null);
        $this->success('注销成功，系统将跳转到登录页面...', U('Index/index'));
    }

}
