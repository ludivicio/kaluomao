<?php

/**
 * 菜单
 */
return array(
    // 导航菜单
    'NAV_MENU' => array(
        'Index' => '首页',
        'Item' => '商品',
        'Member' => '用户',
        'Profile' => '运营',
        'Article' => '文章',
        'Data' => '数据',
        'Template' => '模板',
    ),
    
    // 二级菜单
    'SUB_MENU' => array(
        
        'Index' => array(
            'CommonManage' => array( 
                'title' => '常用操作',
                'Index/index' => '网站信息',
                'Index/sysInfo' => '系统信息',
                'Index/editPwd' => '修改密码',
                'Item/addItem' => '添加商品',
                'Article/addArticle' => '发布文章',
                'Index/clearCache' => '缓存清理',
            ),
        ),
        
        'Item' => array(
            'WorthBuyManage' => array(
                'title' => '值得买',
                'Item/index' => '商品列表',
                'Item/addItem' => '添加商品',
                'Item/category' => '商品分类',
                'Item/addCategory' => '添加分类',
                'Item/comment' => '商品评论',
                'Item/baoliao' => '用户爆料',
                'Item/collect' => '商品采集',
                'Item/localImage' => '图片本地化',
            )
        ),
        
        'Member' => array(
            'UserManage' => array(
                'title' => '普通用户',
                'Member/index' => '用户列表',
                'Member/batch' => '批量注册',
             ),
            'AdminManage' => array(
                'title' => '管理员',
                'Member/manager' => '管理员列表',
                'Member/addManager' => '添加管理员',
            ),
        ),
        
        'Profile' => array(
            'TagManage' => array(
                'title' => '标签管理',
                'Profile/index' => '标签列表',
                'Profile/addTag' => '添加标签',
            ),
            'LinkManage' => array(
                'title' => '友情连接',
                'Profile/link' => '友情连接列表',
                'Profile/addLink' => '添加友情连接',
            ),
            'AdManage' => array(
                'title' => '广告管理',
                'Profile/ad' => '广告列表',
                'Profile/addAd' => '添加广告',
            ),
        ),
        
        'Article' => array(
            'ArticleManage' => array(
                'title' => '文章管理',
                'Article/index' => '文章列表',
                'Article/addArticle' => '添加文章',
                'Article/category' => '文章分类列表',
                'Article/addCategory' => '添加文章分类',
            ),
        ),
        
        'Data' => array(
            'DbManage' => array(
                'title' => '数据库操作',
                'Data/index' => '数据库备份',
                'Data/recovery' => '数据库还原',
                'Data/zip' => '数据库压缩包',
                'Data/repair' => '数据库优化修复',
            ),
            'StaticManage' => array(
                'title' => '静态化数据',
                'Data/staticHtml' => '静态网页',
            ), 
        ),
        
        'Template' => array(
            'ThemeManage' => array(
                'title' => '模板管理',
                'Template/index' => '更换模板',
            ),
        ),
    ),

);
?>