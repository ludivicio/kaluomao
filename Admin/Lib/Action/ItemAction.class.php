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

        import('Class.Category', APP_PATH);

        $items_cate = M('item_cate');
        $cates = $items_cate->where('status = 1')->order(array('order'=>'asc'))->select();
        

        //$cates = Category::unlimitForLevel($cates);


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

        $cate_pid = isset($_GET['id']) ? $_GET['id'] : -1;
        
        // 或者用I()方法代替
        // $cate_pid = I('id', -1, 'intval');

        // 当前选中的分类
        $this->assign('cate_pid', $cate_pid);

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

    // 编辑类别处理
    public function editCateHandle() {
        $this->display();
    }


    // 删除类别处理
    public function delCateHandle() {
        p($_POST);die;
    }


    // 类别排序处理
    public function orderCateHandle() {
        
        if (!IS_POST) {
            halt('页面不存在');
        }

        $orders = $_POST['orders'];

        if($orders == null) {
            return;
        }

        $db = M('item_cate');

        foreach($orders as $id => $val) {

            if(!is_numeric($val) || intval($val) < 0) {
                $val = 0;
            } 

            $db->where(array('id' => $id))->setField('order', $val);
        }

        $this->redirect('Item/category');
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
