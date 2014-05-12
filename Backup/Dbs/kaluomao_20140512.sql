-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 12 日 18:59
-- 服务器版本: 5.5.37
-- PHP 版本: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `kaluomao`
--

-- --------------------------------------------------------

--
-- 表的结构 `ka_admin`
--

CREATE TABLE IF NOT EXISTS `ka_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(16) NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `last_ip` varchar(15) NOT NULL COMMENT '最后登录的ip地址',
  `role_id` smallint(6) NOT NULL COMMENT '角色ID',
  `last_time` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录的时间',
  `email` varchar(45) DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账号是否可用 {0:不可用, 1:可用}',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员信息表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ka_admin`
--

INSERT INTO `ka_admin` (`id`, `account`, `password`, `last_ip`, `role_id`, `last_time`, `email`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '127.0.0.1', 1, 1399889852, 'lurma@qq.com', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ka_admin_role`
--

CREATE TABLE IF NOT EXISTS `ka_admin_role` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '角色名',
  `remark` text NOT NULL COMMENT '备注',
  `order` tinyint(3) NOT NULL COMMENT '排序值',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用 {0:不可用, 1:可用}',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员角色表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ka_article`
--

CREATE TABLE IF NOT EXISTS `ka_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` tinyint(3) unsigned NOT NULL COMMENT '文章类别ID',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `author` varchar(100) NOT NULL COMMENT '文章作者',
  `tags` varchar(45) DEFAULT NULL COMMENT '文章标签',
  `image` varchar(100) NOT NULL COMMENT '缩略图url',
  `content` text NOT NULL COMMENT '文章内容',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `last_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可用 {0:不可用, 1:可用}',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `seo_title` varchar(255) NOT NULL COMMENT 'SEO标题',
  `seo_keys` varchar(255) NOT NULL COMMENT 'SEO关键字',
  `seo_desc` text NOT NULL COMMENT 'SEO描述',
  `comments` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ka_article_cate`
--

CREATE TABLE IF NOT EXISTS `ka_article_cate` (
  `id` tinyint(3) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '类别名称',
  `alias` varchar(45) NOT NULL COMMENT '别名',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `image` varchar(45) DEFAULT NULL COMMENT '图片URL',
  `pid` tinyint(3) unsigned NOT NULL COMMENT '父ID',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用 {0:不可用, 1:可用}',
  `seo_title` varchar(2555) NOT NULL COMMENT 'SEO标题',
  `seo_keys` varchar(255) NOT NULL COMMENT 'SEO关键字',
  `seo_desc` text NOT NULL COMMENT 'SEO描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章类别表';

-- --------------------------------------------------------

--
-- 表的结构 `ka_auto_user`
--

CREATE TABLE IF NOT EXISTS `ka_auto_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统自动生成的用户' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ka_baoliao`
--

CREATE TABLE IF NOT EXISTS `ka_baoliao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `url` varchar(255) NOT NULL COMMENT '链接',
  `origin` varchar(45) NOT NULL COMMENT '来源',
  `content` text NOT NULL COMMENT '内容',
  `email` varchar(255) NOT NULL COMMENT '爆料人邮箱',
  `add_time` int(10) NOT NULL COMMENT '爆料时间',
  `client_ip` varchar(15) NOT NULL COMMENT '客户端IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户爆料表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ka_item`
--

CREATE TABLE IF NOT EXISTS `ka_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '商品标题',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `fid` int(10) unsigned NOT NULL COMMENT '从属ID（B2C，C2C）',
  `tcolor` varchar(10) NOT NULL COMMENT '标题颜色',
  `url` varchar(255) NOT NULL COMMENT '购买链接',
  `price` varchar(10) NOT NULL COMMENT '折扣价',
  `old_price` varchar(10) NOT NULL COMMENT '原价',
  `info` text NOT NULL COMMENT '商品信息',
  `image` varchar(255) NOT NULL COMMENT '商品缩略图',
  `uid` int(10) NOT NULL COMMENT '发布者ID',
  `uname` varchar(100) NOT NULL COMMENT '发布者名称',
  `add_time` int(10) unsigned NOT NULL COMMENT '发布时间',
  `last_time` int(10) unsigned NOT NULL COMMENT '最后修改的时间',
  `good` int(10) unsigned NOT NULL COMMENT '赞',
  `bad` int(10) unsigned NOT NULL COMMENT '踩',
  `favs` int(10) unsigned NOT NULL COMMENT '收藏数',
  `hits` int(10) unsigned NOT NULL COMMENT '点击量',
  `order` tinyint(3) unsigned NOT NULL COMMENT '排序',
  `hot` tinyint(1) NOT NULL COMMENT '是否热门',
  `recommend` tinyint(1) NOT NULL COMMENT '是否推荐',
  `comments` tinyint(3) unsigned NOT NULL COMMENT '评论数',
  `localimage` tinyint(1) NOT NULL COMMENT '本地存储图片',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用 {0:不可用, 1:可用, 2:已过期}',
  `seo_title` varchar(255) NOT NULL COMMENT 'SEO标题',
  `seo_keys` varchar(255) NOT NULL COMMENT 'SEO关键字',
  `seo_desc` text NOT NULL COMMENT 'SEO描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ka_item_cate`
--

CREATE TABLE IF NOT EXISTS `ka_item_cate` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '分类名称',
  `alias` varchar(45) NOT NULL COMMENT '别名',
  `pid` tinyint(3) unsigned NOT NULL COMMENT '父ID',
  `order` tinyint(3) unsigned NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用 {0:不可用, 1:可用}',
  `seo_title` varchar(255) NOT NULL COMMENT 'SEO标题',
  `seo_keys` varchar(255) NOT NULL COMMENT 'SEO关键字',
  `seo_desc` text NOT NULL COMMENT 'SEO描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品分类表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `ka_item_cate`
--

INSERT INTO `ka_item_cate` (`id`, `name`, `alias`, `pid`, `order`, `status`, `seo_title`, `seo_keys`, `seo_desc`) VALUES
(1, '电脑数码', '', 0, 0, 1, '电脑数码', '电脑、3C、数码', '电脑、3C、数码'),
(2, '家用电器', '', 0, 0, 1, '家用电器', '电器、家电', '电器、家电'),
(3, '运动户外', '', 0, 0, 1, '运动户外', '运动、户外', '运动、户外'),
(4, '服饰鞋包', '', 0, 0, 1, '服饰鞋包', '服饰、衣服、女装、鞋包', '服饰、衣服、女装、鞋包'),
(5, '个护化妆', '', 0, 0, 1, '个护化妆', '护理、化妆品', '个人护理、化妆品、美发'),
(6, '母婴用品', '', 0, 0, 1, '母婴用品', '母婴用品', '婴儿用品');

-- --------------------------------------------------------

--
-- 表的结构 `ka_item_comment`
--

CREATE TABLE IF NOT EXISTS `ka_item_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL COMMENT '商品ID',
  `pid` int(10) unsigned NOT NULL COMMENT '父ID',
  `client_ip` varchar(15) NOT NULL COMMENT '发布者的IP',
  `content` text NOT NULL COMMENT '评论内容',
  `add_time` int(10) NOT NULL COMMENT '评论时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用 {0:不可用, 1:可用}',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品评论表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ka_item_from`
--

CREATE TABLE IF NOT EXISTS `ka_item_from` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '大类别的名称',
  `remark` varchar(45) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品所属大分类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ka_item_tag`
--

CREATE TABLE IF NOT EXISTS `ka_item_tag` (
  `item_id` int(10) unsigned NOT NULL COMMENT '商品ID',
  `tag_id` int(10) unsigned NOT NULL COMMENT '标签ID',
  UNIQUE KEY `item_id_UNIQUE` (`item_id`),
  UNIQUE KEY `tag_id_UNIQUE` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品标签对应表';

-- --------------------------------------------------------

--
-- 表的结构 `ka_tag`
--

CREATE TABLE IF NOT EXISTS `ka_tag` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '标签名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
