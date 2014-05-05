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
        if(is_array($value)) {
            foreach($value as $k => $v) {
                $result = $this->getSubMenuName($v, $k);
                if($result) {
                    return $result;
                }
            }
        } else if(strtolower($key) == strtolower(MODULE_NAME . '/' . ACTION_NAME)) {
            return $value;
        }
    }
    
}

?>
