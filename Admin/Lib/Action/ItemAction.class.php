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
        
        // 读取所有的分类
         //$db = M('item_cate');
         $this->categories = M('item_cate')->select();
        // $db->
        
        
        
        $this->display();
    }
    
    public function addCategory() {
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
