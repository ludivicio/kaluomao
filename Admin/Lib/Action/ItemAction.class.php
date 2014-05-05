<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemAction
 *
 * @author LU
 */
class ItemAction extends CommonAction {
    //put your code here
    
    public function index() {
        $this->display();
    }
    
    public function addItem() {
        $this->display();
    }
    
    public function category() {
        
        $this->display();
    }
    
    public function addCategory() {
        // 读取所有的分类
        $this->categories = M('item_cate')->select();
        $this->display();
    }

    public function addCateHandle() {
        if (!IS_POST) {
            halt('页面不存在');
        }

        // p($_POST);die;

        $db = M('item_cate');

        $data = array(
            'name' => $this->_post('name'),
            'alias' => '',
            'pid' => $this->_post('pid'),
            'status' => $this->_post('status'),
            'seo_title' => $this->_post('seo_title'),
            'seo_keys' => $this->_post('seo_keys'),
            'seo_desc' => $this->_post('seo_desc')
        );

        if($db->add($data)) {
            $this->success('添加成功', U('Item/category'));
        } else {
            $this->error('添加失败', U('Item/category'));
        }

    }
    
    public function comment() {
        $this->display();
    }
    
    public function baoliao() {
        $this->display();
    }
    
    public function collect() {
        $this->display();
    }
    
    public function localImage() {
        $this->display();
    }
    
}
