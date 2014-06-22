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
class ProfileAction extends CommonAction {

    //put your code here

    public function index() {

        // 读取所有的商城
        $malls = M('mall')->order(array('order'=>'asc'))->select();
        
        $this->assign('malls', $malls);

        $this->display();
    }

    public function orderMallHandle() {

        if (!IS_POST) {
            halt('页面不存在');
        }

        $orders = $_POST['orders'];

        if($orders == null) {
            return;
        }

        $db = M('mall');

        foreach($orders as $id => $val) {

            if(!is_numeric($val) || intval($val) < 0) {
                $val = 0;
            } 

            $db->where(array('id' => $id))->setField('order', $val);
        }

        $this->redirect('Profile/index');
    }

    public function delMallHandle() {

        // 获取传入的id
        $id = isset($_GET['id']) ? $_GET['id'] : -1;

        if($id == -1) {
            return;
        }

        $db = M('mall');

        // 删除
        $db->where(array('id' => $id))->delete(); 
        

        $this->success('删除成功', U('Profile/index'));
    }


    public function addMall() {
        
        $id = isset($_GET['id']) ? $_GET['id'] : -1;
        
        if($id != -1) {
            $mall = M('mall')->where(array('id' => $id))->find();
        }

        //p($mall) ;
        
        $this->assign('mall', $mall);

        $this->display();

    }

    public function addMallHandle() {
        
        if (!IS_POST) {
            halt('页面不存在');
        }

        // p($_POST);die;
  
        $id = isset($_POST['id']) ? $_POST['id'] : -1;

        // 商城名称
        $name = I('name', '', 'htmlspecialchars');
        if ($name == '') {
            $this->error('商城名称不能为空！');
        }

        // 商城描述
        $desc = I('desc', '', 'htmlspecialchars');
        if ($desc == '') {
            $this->error('商城描述不能为空！');
        }

        $image = '';
        //保存上传图片
        if ($_FILES['bimage']['name'] != '') {
            $dir = './Uploads/malls/';
            if (!file_exists($dir)) {
                mkdir($dir);
            }
            $dir = $dir . date("Ymd");
            mkdir($dir);

            $thumb = array(
                'width' => '90',
                'height' => '45',
                'prefix' => ''
            );

            $upload_info = $this->upload($dir .'/', $thumb);

            $image = $dir . '/' . $upload_info['0']['savename'];

        } else {
            $this->error('请选择商城图片！');
        }

        $db = M('mall');

        // 时间
        $time = time();

        $data = array(
            'name' => $name,
            'remark' => I('remark', '', 'htmlspecialchars'),
            'desc' => $desc,
            'bimage' => $image,
            'order' => I('order', 0, 'intval'), // 排序
            'add_time' => $time,
            'last_time' => $time,
            'seo_title' => I('seo_title', '', 'htmlspecialchars'), // SEO TITLE
            'seo_keys' => I('seo_keys', '', 'htmlspecialchars'), // SEO KEYS
            'seo_desc' => I('seo_desc', '', 'htmlspecialchars') // SEO DESCRIPTION
        );

        if($id > 0) {
            
            // 修改商城
            if($db->where(array('id' => $id))->save($data)) {
                $this->success('修改成功', U('Profile/index'));
            } else {
                $this->error('修改失败', U('Profile/addMall'));
            }

        } else {
            
            // 添加商城
            if($db->add($data)) {
                $this->success('添加成功', U('Profile/index'));
            } else {
                $this->error('添加失败', U('Profile/addMall'));
            } 
        }

        //p($data);die;
    }


    public function tag() {

    }

    public function addTag() {
        $this->display();
    }

    public function link() {
        $this->display();
    }

    public function addLink() {
        $this->display();
    }

    public function ad() {
        $this->display();
    }

    public function addAd() {
        $this->display();
    }

}
