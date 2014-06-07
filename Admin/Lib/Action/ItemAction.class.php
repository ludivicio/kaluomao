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

        import('Class.Category', APP_PATH);

        // 读取所有的分类
        $categories = M('item_cate')->select();
        // 对分类进行递归排序
        $categories = Category::unlimitForLevel($categories, '&nbsp;&nbsp;&nbsp;|—&nbsp;');

        $this->assign('categories', $categories);


        $this->display();
    }

    public function addItemHandle()
    {
        if (!IS_POST) {
            halt('页面不存在');
        }

        // p($_POST);

        // 标题
        $title = I('title');
        if ($title == '') {
            $this->error('标题不能为空！');
        }
        // 商品连接
        $url = I('url');
        if ($url == '') {
            $this->error('链接不能为空！');
        }
        // 发布商品的用户
        $uid = I('uid');
        $uname = I('uname');
        if($uname == '') {
            // 从数据库中随机读取一个用户
            $uname = '张三';
            $uid = '2';
        }

        // 远程图片地址
        $image = I('remote_image');
        $local_image = I('save_image');
        if($image == '') {
            //保存上传图片
            if ($_FILES['local_image']['name'] != '') {
                $dir = './Uploads/items/';
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
                $dir = $dir . date("Ymd");
                mkdir($dir);
                $upload_info = $this->upload($dir .'/');
                $image = $dir . '/' . $upload_info['0']['savename'];
                // 从本地上传图片的话，localimage = TRUE
                $local_image = 1;
            } else {
                $local_image = 0;
            }
        } else {
            // 选中了“保存到本地”选项
            if($local_image != '') {
                // 下载图片，并返回保存的路径
                $temp_image = $this->download_image($image);
                echo 'temp_image: ' . $temp_image;
                if($temp_image != '') {
                    $image = $temp_image;
                    $local_image = 1;
                } else {
                    $local_image = 0;
                }
            } else {
                $local_image = 0;
            }
        }

        // 来自哪个网站
        $fid = I('from', 0, 'intval');
        if ($fid == 0) {
           // $this->error('请选择来源！');
        }

        // 分类ID
        $cid = I('cid', 0, 'intval');
        if ($cid == 0) {
            $this->error('请选择分类！');
        }
        // 原价
        $old_price = I('old_price', -1, 'intval');
        // 折后价
        $price = I('price', -1, 'intval');
        if($old_price < 0 || $price < 0) {
            $this->error('价钱填写错误！');
        }

        // 是否热门
        $is_hot = I('is_hot', 0, 'intval');
        // 是否推荐
        $is_recommend = I('is_recommend', 0, 'intval');
        // 审核状态
        $status = I('status', 0, 'intval');
        // 赞
        $good = I('good', 0, 'intval');
        // 踩
        $bad = I('bad', 0, 'intval');
        // 收藏数
        $favs = I('favs', 0, 'intval');
        // 点击量
        $hits = I('hits', 0, 'intval');
        // 排序
        $order = I('order', 0, 'intval');

        // 商品标签， 需要分割并过滤
        $tags = I('tags');
        if ($tags) {
            //标签不存在则添加
            $tags_arr = explode(' ', $_POST['tags']);
            $tags_arr = array_unique($tags_arr);

            /*
            foreach ($tags_arr as $tag) {
                $isset_id = $items_tags->field('id')->where("name='".$tag."' and pid='".$data['cid']."' and is_del=0")->find();
                if ($isset_id) {
                    $items_tags_item->add(array(
                        'item_id' => $id,
                        'tag_id' => $isset_id['id'],
                    ));
                    $items_tags->where("id='".$isset_id['id']."'")->setInc('item_nums'); //标签item_nums加1
                } else {
                    $tag_id = $items_tags->add(array('name' => $tag));
                    $items_tags_item->add(array(
                        'item_id' => $id,
                        'tag_id' => $tag_id
                    ));
                    $items_tags->where("id='".$tag_id."'")->setInc('item_nums'); //标签item_nums加1
                }
            }
            */
        }

        // 文章内容, 需要对内容进行过滤
        $info = I('info');
        // SEO TITLE
        $seo_title = I('seo_title');
        // SEO KEYS
        $seo_keys = I('seo_keys');
        // SEO DESCRIPTION
        $seo_desc = I('seo_desc');


        $time = time();

        $data = array(

            'title' => $title,
            'cid' => $cid,
            'fid' => $fid,

            // 标题颜色
            'tcolor' => I('color'),

            'url' => $url,
            'price' => $price,
            'old_price' => $old_price,
            'image' => $image,
            'localimage'=> $local_image,
            'uid' => $uid,
            'uname' => $uname,

            // 添加时间
            'add_time' => $time,
            // 最后修改的时间
            'last_time' => $time,

            'good' => $good,
            'bad' => $bad,
            'favs' => $favs,
            'hits' => $hits,
            'hot' => $is_hot,
            'recommend' => $is_recommend,
            'status' => $status,
            'order' => $order,

            // 评论数
            'comments' => 0,
            'seo_title' => $seo_title,
            'seo_keys' => $seo_keys,
            'seo_desc' => $seo_desc,

            // 商品正文
            'info' => $info
        );

        p($data);

        die;

        if(M('item')->add($data)) {
            $this->success('添加成功', U('Item/index'));
        } else {
            $this->error('添加失败');
        }

    }

    public function _upload() {

    }



    public function category() {

        import('Class.Category', APP_PATH);

        $items_cate = M('item_cate');
        $cates = $items_cate->order(array('order'=>'asc'))->select();
        

        $cates = Category::unlimitForLevel($cates, '&nbsp;&nbsp;&nbsp;|—&nbsp;');

        $this->assign('cates', $cates);

        $this->display();
    }
    
    // 添加分类
    public function addCate() {

        $id = isset($_GET['id']) ? $_GET['id'] : -1;
        
        // 或者用I()方法代替
        // $id = I('id', -1, 'intval');
        
        // 当前选中的分类
        $this->assign('cate_pid', $id);

        import('Class.Category', APP_PATH);
        
        // 读取所有的分类
        $categories = M('item_cate')->select();
        // 对分类进行递归排序
        $categories = Category::unlimitForLevel($categories, '&nbsp;&nbsp;&nbsp;|—&nbsp;');

        $this->assign('categories', $categories);

        $this->display();
    }

    // 添加分类处理
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

    // 编辑分类
    public function editCate() {

        // 获取传入的id
        $id = isset($_GET['id']) ? $_GET['id'] : -1;

        if($id == -1) {
            return;
        }

        $db = M('item_cate');

        // 读取当前分类信息
        $cate = $db->where(array('id' => $id))->find();

        import('Class.Category', APP_PATH);
        
        // 读取所有的分类信息
        $categories = $db->select();
        // 对分类进行递归排序
        $categories = Category::unlimitForLevel($categories, '&nbsp;&nbsp;&nbsp;|—&nbsp;');

        $this->assign('cate', $cate);
        $this->assign('categories', $categories);
        
        $this->display();
    }

    // 编辑类别处理
    public function editCateHandle() {

        if (!IS_POST) {
            halt('页面不存在');
        }

        // 获取传入的id
        $id = isset($_POST['id']) ? $_POST['id'] : -1;

        if($id == -1) {
            return;
        }

        $db = M('item_cate');

        $data = array(
            'name' => $this->_post('name'),
            'pid' => $this->_post('pid'),
            'status' => $this->_post('status'),
            'order' => $this->_post('order'),
            'seo_title' => $this->_post('seo_title'),
            'seo_keys' => $this->_post('seo_keys'),
            'seo_desc' => $this->_post('seo_desc')
        );

        $result = $db->where(array('id' => $id))->save($data);

        if($result) {
            $this->success('修改成功', U('Item/category'));
        } else {
            $this->error('修改失败', U('Item/category'));
        }

    }


    // 删除类别处理
    public function delCateHandle() {
        
        import('Class.Category', APP_PATH);
        
        // 获取传入的id
        $id = isset($_GET['id']) ? $_GET['id'] : -1;

        if($id == -1) {
            return;
        }

        $db = M('item_cate');

        $categories = M('item_cate')->select();

        // 获取该类的所有子类ID
        $ids = Category::getChildIds($categories, $id);
        $ids[] = $id;
        
        // 依次删除
        foreach($ids as $val) {
            $db->where(array('id' => $val))->delete(); 
        }

        $this->success('删除成功', U('Item/category'));
        
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


    // 修改分类的状态，使用或禁用
    public function updateStatus() {

        // 获取传入的id
        $id = isset($_GET['id']) ? $_GET['id'] : -1;

        if($id == -1) {
            return;
        }
        
        $db = M('item_cate');

        $status = $db->where(array('id' => $id))->getField('status');
        $status = ($status == 0 ? 1 : 0);
        $result = $db->where(array('id' => $id))->setField('status', $status);
        
        if($result) {
            echo json_encode(array('data' => $status));
        } else {
            $this->error('状态修改失败', U('Item/category'));
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
