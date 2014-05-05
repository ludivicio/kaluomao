SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `kaluomao` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `kaluomao` ;

-- -----------------------------------------------------
-- Table `kaluomao`.`ka_admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_admin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `account` VARCHAR(16) NOT NULL DEFAULT '' COMMENT '账号',
  `password` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `last_ip` VARCHAR(15) NOT NULL COMMENT '最后登录的ip地址',
  `role_id` SMALLINT NOT NULL COMMENT '角色ID',
  `last_time` INT(10) NOT NULL DEFAULT 0 COMMENT '最后登录的时间',
  `email` VARCHAR(45) NULL COMMENT '邮箱',
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '账号是否可用 {0:不可用, 1:可用}',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `account` (`account` ASC))
ENGINE = MyISAM
COMMENT = '管理员信息表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_admin_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_admin_role` (
  `id` TINYINT(3) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL COMMENT '角色名',
  `remark` TEXT NOT NULL COMMENT '备注',
  `order` TINYINT(3) NOT NULL COMMENT '排序值',
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否可用 {0:不可用, 1:可用}',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '管理员角色表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_article`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_article` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cate_id` TINYINT(3) UNSIGNED NOT NULL COMMENT '文章类别ID',
  `title` VARCHAR(255) NOT NULL COMMENT '文章标题',
  `author` VARCHAR(100) NOT NULL COMMENT '文章作者',
  `tags` VARCHAR(45) NULL COMMENT '文章标签',
  `image` VARCHAR(100) NOT NULL COMMENT '缩略图url',
  `content` TEXT NOT NULL COMMENT '文章内容',
  `hits` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点击数',
  `add_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `last_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后修改时间',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否可用 {0:不可用, 1:可用}',
  `order` TINYINT(3) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `seo_title` VARCHAR(255) NOT NULL COMMENT 'SEO标题',
  `seo_keys` VARCHAR(255) NOT NULL COMMENT 'SEO关键字',
  `seo_desc` TEXT NOT NULL COMMENT 'SEO描述',
  `comments` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论数',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '文章表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_article_cate`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_article_cate` (
  `id` TINYINT(3) NOT NULL,
  `name` VARCHAR(100) NOT NULL COMMENT '类别名称',
  `alias` VARCHAR(45) NOT NULL COMMENT '别名',
  `type` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '类型',
  `image` VARCHAR(45) NULL COMMENT '图片URL',
  `pid` TINYINT(3) UNSIGNED NOT NULL COMMENT '父ID',
  `order` TINYINT(3) UNSIGNED NOT NULL DEFAULT 255 COMMENT '排序',
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否可用 {0:不可用, 1:可用}',
  `seo_title` VARCHAR(2555) NOT NULL COMMENT 'SEO标题',
  `seo_keys` VARCHAR(255) NOT NULL COMMENT 'SEO关键字',
  `seo_desc` TEXT NOT NULL COMMENT 'SEO描述',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '文章类别表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_auto_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_auto_user` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL COMMENT '名称',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '系统自动生成的用户';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_item` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL COMMENT '商品标题',
  `cid` INT(10) UNSIGNED NOT NULL COMMENT '分类ID',
  `fid` INT(10) UNSIGNED NOT NULL COMMENT '从属ID（B2C，C2C）',
  `tcolor` VARCHAR(10) NOT NULL COMMENT '标题颜色',
  `url` VARCHAR(255) NOT NULL COMMENT '购买链接',
  `price` VARCHAR(10) NOT NULL COMMENT '折扣价',
  `old_price` VARCHAR(10) NOT NULL COMMENT '原价',
  `info` TEXT NOT NULL COMMENT '商品信息',
  `image` VARCHAR(255) NOT NULL COMMENT '商品缩略图',
  `uid` INT(10) NOT NULL COMMENT '发布者ID',
  `uname` VARCHAR(100) NOT NULL COMMENT '发布者名称',
  `add_time` INT(10) UNSIGNED NOT NULL COMMENT '发布时间',
  `last_time` INT(10) UNSIGNED NOT NULL COMMENT '最后修改的时间',
  `good` INT(10) UNSIGNED NOT NULL COMMENT '赞',
  `bad` INT(10) UNSIGNED NOT NULL COMMENT '踩',
  `favs` INT(10) UNSIGNED NOT NULL COMMENT '收藏数',
  `hits` INT(10) UNSIGNED NOT NULL COMMENT '点击量',
  `order` TINYINT(3) UNSIGNED NOT NULL COMMENT '排序',
  `hot` TINYINT(1) NOT NULL COMMENT '是否热门',
  `recommend` TINYINT(1) NOT NULL COMMENT '是否推荐',
  `comments` TINYINT(3) UNSIGNED NOT NULL COMMENT '评论数',
  `localimage` TINYINT(1) NOT NULL COMMENT '本地存储图片',
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否可用 {0:不可用, 1:可用, 2:已过期}',
  `seo_title` VARCHAR(255) NOT NULL COMMENT 'SEO标题',
  `seo_keys` VARCHAR(255) NOT NULL COMMENT 'SEO关键字',
  `seo_desc` TEXT NOT NULL COMMENT 'SEO描述',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '商品表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_item_cate`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_item_cate` (
  `id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL COMMENT '分类名称',
  `alias` VARCHAR(45) NOT NULL COMMENT '别名',
  `pid` TINYINT(3) UNSIGNED NOT NULL COMMENT '父ID',
  `order` TINYINT(3) UNSIGNED NOT NULL COMMENT '排序',
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否可用 {0:不可用, 1:可用}',
  `seo_title` VARCHAR(255) NOT NULL COMMENT 'SEO标题',
  `seo_keys` VARCHAR(255) NOT NULL COMMENT 'SEO关键字',
  `seo_desc` TEXT NOT NULL COMMENT 'SEO描述',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '商品分类表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_item_comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_item_comment` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` INT(10) UNSIGNED NOT NULL COMMENT '商品ID',
  `pid` INT(10) UNSIGNED NOT NULL COMMENT '父ID',
  `client_ip` VARCHAR(15) NOT NULL COMMENT '发布者的IP',
  `content` TEXT NOT NULL COMMENT '评论内容',
  `add_time` INT(10) NOT NULL COMMENT '评论时间',
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否可用 {0:不可用, 1:可用}',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '商品评论表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_tag` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL COMMENT '标签名',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '标签表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_item_tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_item_tag` (
  `item_id` INT(10) UNSIGNED NOT NULL COMMENT '商品ID',
  `tag_id` INT(10) UNSIGNED NOT NULL COMMENT '标签ID',
  UNIQUE INDEX `item_id_UNIQUE` (`item_id` ASC),
  UNIQUE INDEX `tag_id_UNIQUE` (`tag_id` ASC))
ENGINE = MyISAM
COMMENT = '商品标签对应表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_baoliao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_baoliao` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL COMMENT '标题',
  `url` VARCHAR(255) NOT NULL COMMENT '链接',
  `origin` VARCHAR(45) NOT NULL COMMENT '来源',
  `content` TEXT NOT NULL COMMENT '内容',
  `email` VARCHAR(255) NOT NULL COMMENT '爆料人邮箱',
  `add_time` INT(10) NOT NULL COMMENT '爆料时间',
  `client_ip` VARCHAR(15) NOT NULL COMMENT '客户端IP',
  PRIMARY KEY (`id`))
ENGINE = MyISAM
COMMENT = '用户爆料表';


-- -----------------------------------------------------
-- Table `kaluomao`.`ka_item_from`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kaluomao`.`ka_item_from` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL COMMENT '大类别的名称',
  `remark` VARCHAR(45) NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = MyISAM
COMMENT = '商品所属大分类';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
