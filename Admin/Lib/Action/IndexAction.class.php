<?php

/**
 *
 */
class IndexAction extends CommonAction {

    // 显示首页
    public function index() {
        $this->display();
    }

    public function sysInfo() {
        $info = $this->serverInfo();
        $this->assign('server_info', $info);
        $this->display();
    }

    public function editPwd() {
        $this->display();
    }

    public function editPwdHandle() {
       
       if(IS_POST) {

            $oldPwd = $this->_post('oldPwd');
            $newPwd = $this->_post('newPwd');
            $confirmPwd = $this->_post('confirmPwd');

            //echo $oldPwd . ' ' . $newPwd . ' ' . $confirmPwd;
            
            // 服务器端验证用户输入的信息
            // 用户输入信息不完整
            if(!$oldPwd || !$newPwd || !$confirmPwd) {
                echo json_encode(array('status' => 0, 'info' => '信息不完整', 'url' => U('Index/editPwd')));
                return;
            }
            // 两次密码不一致
            if($newPwd != $confirmPwd) {
                echo json_encode(array('status' => 0, 'info' => '两次密码不一致', 'url' => U('Index/editPwd')));
                return;
            }

            $where = array('account' => $_SESSION['account']);
            $admin = M('admin')->where($where)->find();

            if($admin) {
                $pwd = $admin['password'];
                if($pwd != md5($oldPwd)) {
                    echo json_encode(array('status' => 0, 'info' => '密码输入错误', 'url' => U('Index/editPwd')));
                    return;
                }

                $data = array(
                    'id' => $admin['id'], 
                    'password' => md5($newPwd),
                );

                M('admin')->save($data);

                echo json_encode(array('status' => 1, 'info' => '密码修改成功', 'url' => U('Index/editPwd')));
            }
        }
    }

    public function clearCache() {
        $this->display();
    }

    public function serverInfo() {
        if (function_exists('gd_info')) {
            $gd = gd_info();
            $gd = $gd['GD Version'];
        } else {
            $gd = "不支持";
        }

        $info = array(
            '操作系统' => PHP_OS,
            '主机名IP端口' => $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . ')',
            '运行环境' => $_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式' => php_sapi_name(),
            '程序目录' => WEB_ROOT,
            'MYSQL版本' => function_exists("mysql_close") ? mysql_get_client_info() : '不支持',
            'GD库版本' => $gd,
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time') . "秒",
            '剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
            '服务器时间' => date("Y年n月j日 H:i:s"),
            '北京时间' => gmdate("Y年n月j日 H:i:s", time() + 8 * 3600),
            '采集函数检测' => ini_get('allow_url_fopen') ? '支持' : '不支持',
            'register_globals' => get_cfg_var("register_globals") == "1" ? "ON" : "OFF",
            'magic_quotes_gpc' => (1 === get_magic_quotes_gpc()) ? 'YES' : 'NO',
            'magic_quotes_runtime' => (1 === get_magic_quotes_runtime()) ? 'YES' : 'NO',
        );

        return $info;
    }

}
