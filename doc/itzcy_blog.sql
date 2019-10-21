/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : itzcy_blog

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-07-23 22:53:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_title` varchar(255) NOT NULL DEFAULT '',
  `art_banner_url` varchar(255) NOT NULL DEFAULT '',
  `art_create_at` int(11) unsigned NOT NULL DEFAULT '0',
  `art_update_at` int(11) unsigned NOT NULL DEFAULT '0',
  `art_desc` varchar(255) NOT NULL,
  `art_content` text NOT NULL,
  `art_content_text` text NOT NULL,
  `art_author_id` int(11) NOT NULL DEFAULT '0',
  `art_author_name` varchar(255) NOT NULL DEFAULT '',
  `art_class_id` int(11) NOT NULL DEFAULT '0',
  `art_class_name` varchar(128) NOT NULL DEFAULT '',
  `art_status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '1 show 2 hide',
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('85', '新版本上线喽', '/upload/image/20180615/1529077877545077.jpg', '1525614998', '1526808470', '新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线', '<p>新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！a</p>', '新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！a\n', '1', 'itzcy', '0', '未分类', '1');
INSERT INTO `article` VALUES ('87', 'asdf ', '', '1529250948', '1529250948', 'asdf ', '<p>asfd&nbsp;</p>', 'asfd \n', '1', 'itzcy', '0', '未分类', '1');
INSERT INTO `article` VALUES ('88', 'jkhsdfjk', '/upload/image/20180617/1529251005744489.jpg', '1529251008', '1529251008', 'djkasdfgkh', '<p>sdfgsdfgsd</p>', 'sdfgsdfgsd\n', '1', 'itzcy', '3', 'Class333abc1', '1');
INSERT INTO `article` VALUES ('89', 'asdfasd ', '/upload/image/20180617/1529251034713295.jpg', '1529251036', '1529251036', 'asdfasdf', '<p>asfdasdfa</p>', 'asfdasdfa\n', '1', 'itzcy', '0', '未分类', '1');
INSERT INTO `article` VALUES ('90', '阿斯蒂芬', '', '1529254303', '1529254303', '', '', '\n', '1', 'itzcy', '0', '未分类', '1');
INSERT INTO `article` VALUES ('91', '新版本上线喽', '/upload/image/20180615/1529077877545077.jpg', '1529254560', '1529254560', '新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线', '<p>新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！ab</p>', '新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！新版本上线喽！！！ab\n', '1', 'itzcy', '0', '未分类', '1');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_class_name` varchar(64) NOT NULL,
  `create_at` int(11) NOT NULL DEFAULT '0',
  `update_at` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1 正常 0 删除',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '默认分类', '0', '1524841887', '1');
INSERT INTO `category` VALUES ('2', '程序实验室', '0', '1526810594', '1');
INSERT INTO `category` VALUES ('3', 'Class333abc1', '0', '0', '0');
INSERT INTO `category` VALUES ('4', 'asdfasdfaasdfasdfaasd', '1524840423', '0', '0');
INSERT INTO `category` VALUES ('5', 't', '1526810571', '0', '0');
INSERT INTO `category` VALUES ('6', 'new Category1', '1529232550', '0', '0');

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `l_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(64) NOT NULL DEFAULT '',
  `link_url` varchar(255) NOT NULL,
  `create_time` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000',
  `update_time` int(11) unsigned zerofill DEFAULT '00000000000',
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of links
-- ----------------------------

-- ----------------------------
-- Table structure for sys_action
-- ----------------------------
DROP TABLE IF EXISTS `sys_action`;
CREATE TABLE `sys_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `controller` varchar(64) NOT NULL COMMENT '控制器',
  `action` varchar(64) NOT NULL COMMENT '动作',
  `name` varchar(64) NOT NULL COMMENT '每个动作的名称',
  `module_id` int(11) unsigned NOT NULL COMMENT '对应的模块id',
  `action_sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'action 排序 越大越靠后',
  `is_menu` enum('y','n') NOT NULL DEFAULT 'y' COMMENT '是否是左侧菜单 y是 n 不是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='授权表-controller-action 映射';

-- ----------------------------
-- Records of sys_action
-- ----------------------------
INSERT INTO `sys_action` VALUES ('1', 'manage', 'manage_list', '人员列表', '2', '1', 'y');
INSERT INTO `sys_action` VALUES ('2', 'manage', 'group_list', '用户组列表', '2', '2', 'y');
INSERT INTO `sys_action` VALUES ('3', 'manage', 'auth_list', '权限管理', '2', '3', 'y');
INSERT INTO `sys_action` VALUES ('4', 'system', 'base', '基础数据设置', '1', '1', 'y');
INSERT INTO `sys_action` VALUES ('5', 'article', 'index', '文章管理', '3', '0', 'y');
INSERT INTO `sys_action` VALUES ('6', 'article', 'art_add', '添加文章', '3', '0', 'y');
INSERT INTO `sys_action` VALUES ('7', 'article', 'art_edit', '编辑文章', '3', '0', 'n');
INSERT INTO `sys_action` VALUES ('8', 'article', 'art_del', '删除文章', '3', '0', 'n');
INSERT INTO `sys_action` VALUES ('9', 'article', 'art_enable_or_disable', '文章状态编辑', '3', '0', 'n');
INSERT INTO `sys_action` VALUES ('10', 'category', 'index', '分类管理', '4', '0', 'y');
INSERT INTO `sys_action` VALUES ('11', 'category', 'cat_add', '添加分类', '4', '0', 'y');
INSERT INTO `sys_action` VALUES ('12', 'wechat', 'log', '微信日志', '5', '10', 'y');
INSERT INTO `sys_action` VALUES ('13', 'wechat', 'setting', '微信配置', '5', '20', 'y');
INSERT INTO `sys_action` VALUES ('16', 'test', 'index', 'Test', '5', '0', 'y');
INSERT INTO `sys_action` VALUES ('17', 'Sbs', 'indexs', 'qdm107081506123123', '1', '0', 'y');

-- ----------------------------
-- Table structure for sys_config
-- ----------------------------
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE `sys_config` (
  `s_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `k` varchar(255) NOT NULL,
  `v` varchar(255) NOT NULL,
  `type` varchar(16) NOT NULL DEFAULT 'txt',
  `create_at` int(11) DEFAULT '1525593069',
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sys_config
-- ----------------------------
INSERT INTO `sys_config` VALUES ('1', 'site_title', '辰云博客 | Cyblog', '', '1525593069', '1526808459');
INSERT INTO `sys_config` VALUES ('2', 'site_keywords', 'cyblog,itzcy,辰云博客', '', '1525593069', '1525617640');
INSERT INTO `sys_config` VALUES ('3', 'site_descption', 'CyblogV1.0.0as', '', '1525593069', '1529155398');
INSERT INTO `sys_config` VALUES ('4', 'article_default_banner_url', '/static/app/article/default_banner.jpg', '', '1525593069', '1525617623');

-- ----------------------------
-- Table structure for sys_group
-- ----------------------------
DROP TABLE IF EXISTS `sys_group`;
CREATE TABLE `sys_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `group_name` varchar(64) NOT NULL DEFAULT '' COMMENT '模块名称',
  `group_actions` varchar(2048) NOT NULL DEFAULT '' COMMENT '管理的action 内容',
  `group_remarks` varchar(256) NOT NULL DEFAULT '' COMMENT '备注',
  `group_status` tinyint(255) NOT NULL DEFAULT '1' COMMENT '0 冻结 1 正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='管理模块分组 管理组表';

-- ----------------------------
-- Records of sys_group
-- ----------------------------
INSERT INTO `sys_group` VALUES ('1', '超级管理员', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"16\"]', '', '1');
INSERT INTO `sys_group` VALUES ('2', '系统管理员', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"16\"]', '', '1');

-- ----------------------------
-- Table structure for sys_manage
-- ----------------------------
DROP TABLE IF EXISTS `sys_manage`;
CREATE TABLE `sys_manage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(24) NOT NULL DEFAULT '' COMMENT '后台管理的用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `password_salt` varchar(12) NOT NULL DEFAULT '' COMMENT '密码盐',
  `truename` varchar(32) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `majro` varchar(32) NOT NULL DEFAULT '' COMMENT '专业',
  `telphone` varchar(32) NOT NULL COMMENT '手机号',
  `email` varchar(32) NOT NULL COMMENT '邮箱',
  `auth_group` varchar(64) NOT NULL DEFAULT '0' COMMENT '授权模块(组,group) 关联字段',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `change_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `administrator` tinyint(11) unsigned DEFAULT '0' COMMENT '0',
  `status` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '是否禁用 0:表示禁用；1:表示启用',
  `remarks` varchar(256) NOT NULL DEFAULT '' COMMENT '备注',
  `login_ip` varchar(32) NOT NULL DEFAULT '0' COMMENT '上一次登录ip',
  `login_time` varchar(32) NOT NULL DEFAULT '0' COMMENT '上一次登录时间',
  `login_number` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`id`),
  KEY `auth_group` (`auth_group`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='后台管理人员表';

-- ----------------------------
-- Records of sys_manage
-- ----------------------------
INSERT INTO `sys_manage` VALUES ('1', 'itzcy', '073c3e53ca586eb791d7a9ba99126c1a', '3913', '张辰云', 'Full Stack Developer\n\n', '17013408381', 'itzcy@qq.com', '[\"1\",\"2\"]', '1', '11', '1', '1', 'asfasfdasfdasdasfasfd', '127.0.0.1', '1532351932', '109');

-- ----------------------------
-- Table structure for sys_module
-- ----------------------------
DROP TABLE IF EXISTS `sys_module`;
CREATE TABLE `sys_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `module_name` varchar(64) NOT NULL DEFAULT '' COMMENT '模块名称',
  `module_controller` varchar(64) NOT NULL DEFAULT '',
  `module_iconfount` varchar(64) NOT NULL DEFAULT '',
  `module_sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序 越大越靠后',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='模块归类表';

-- ----------------------------
-- Records of sys_module
-- ----------------------------
INSERT INTO `sys_module` VALUES ('1', '系统设置', 'system', 'layui-icon-set-fill', '20');
INSERT INTO `sys_module` VALUES ('2', '管理权限设置', 'manage', 'layui-icon-user', '19');
INSERT INTO `sys_module` VALUES ('3', '文章管理', 'article', 'layui-icon-list', '10');
INSERT INTO `sys_module` VALUES ('4', '分类管理', 'category', 'layui-icon-tabs', '11');
INSERT INTO `sys_module` VALUES ('5', '微信管理', 'wechat', 'layui-icon-login-wechat', '12');
