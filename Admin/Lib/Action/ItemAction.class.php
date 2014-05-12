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

        $items_cate = M('item_cate');
        $cates = $items_cate->where('status = 1')->order(array('order'=>'desc'))->select();

        foreach ($cates as $val) {
            if ($val['pid'] == 0) {
                $categories['parent'][] = $val;
            }else {
                $categories['child'][$val['pid']][] = $val;
            }
        }

        $this->assign('cates_list', $categories);

        $this->display();
    }
    
    public function addCate() {

        $cur_cate = $_GET['id'];
        if($cur_cate != null) {
            // 当前选中的分类
            $this->assign('cur_cate', $cur_cate);
        }

        // 读取所有的分类
        $categories = M('item_cate')->select();
        $this->assign('categories', $categories);

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
            'order' => $this->_post('order'),
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

    public function editCate() {
        $this->display();
    }

    public function editCateHandle() {
        $this->display();
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
