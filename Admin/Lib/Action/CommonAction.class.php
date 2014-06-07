<?php

/*
 *
 * 
 */

class CommonAction extends Action {

    public function _initialize() {

        // 采用utf-8格式编码
        header('Content-type:text/html; charset=utf-8');
        header('Content-type:application/json; charset=utf-8');

        // 检测用户是否已经登录
        if (!isset($_SESSION['uid'])) {
            $this->redirect('Login/index');
        }

        // 用户的角色信息
        $this->assign('account', $_SESSION['account']);
        $this->assign('roleName', $_SESSION['role_name']);

        // 用户访问的模块和方法
        $this->assign('module', MODULE_NAME);
        $this->assign('action', MODULE_NAME . '/' . ACTION_NAME);

        // 获取当前模块名称
        $this->assign('nav_name', $this->getNavName());

        // 读取菜单项
        $subMenu = $this->getSubMenu();
        $this->assign('sub_menu', $subMenu);

        // 获取当前操作名称
        $this->assign('sub_menu_name', $this->getSubMenuName($subMenu));

    }

    /**
     * 获取导航菜单名称
     * @return string
     */
    private function getNavName() {
        $module = MODULE_NAME;
        $cache = C('NAV_MENU');
        if ($cache[$module]) {
            return $cache[$module];
        }
        return '';
    }

    /**
     * 获取二级菜单数组
     * @return type
     */
    private function getSubMenu() {
        $module = MODULE_NAME;
        $cache = C('SUB_MENU');
        if ($cache[$module]) {
            return $cache[$module];
        }
        return array();
    }

    private function getSubMenuName($value, $key = '') {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $result = $this->getSubMenuName($v, $k);
                if ($result) {
                    return $result;
                }
            }
        } else if (strtolower($key) == strtolower(MODULE_NAME . '/' . ACTION_NAME)) {
            return $value;
        }
    }


    /**
     * 图片上传方法
     * @param $savePath
     * @param array $thumb
     * @return array
     */
    public function upload($savePath, $thumb = array()) {

        import("ORG.Net.UploadFile");

        $upload = new UploadFile();
        $upload->maxSize = 2097152; // 设置附件上传大小
        $upload->savePath = $savePath; // 设置附件上传目录
        $upload->saveRule = 'uniqid';
        $upload->allowExts = array('jpg', 'png', 'jpeg'); // 设置附件上传类型

        if ($thumb) {
            $upload->thumb = true;
            $upload->thumbMaxWidth = $thumb['width'];
            $upload->thumbMaxHeight = $thumb['height'];
            $upload->thumbPrefix = 's_';
            $upload->thumbRemoveOrigin = true;
        }

        if (!$upload->upload()) {
            // 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        } else {
            // 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
        }
        return $info;
    }

    //下载远程图片
    public function download_image($path) {
        $dir = date("Ymd");
        mkdir('./Uploads/items/' . $dir);
        $type = end(explode('.', $path));

        //文件名
        $name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $type;

        import("ORG.Net.Http");
        $http = new Http();
        $http->curlDownload($path, 'Uploads/items/' . $dir . '/' . $name);
        return 'Uploads/items/' . $dir . '/' . $name;
    }


}

?>
