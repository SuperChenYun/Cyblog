-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019-11-21 17:52:08
-- 服务器版本： 10.1.30-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_itzcy_com`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `art_id` int(11) NOT NULL,
  `art_title` varchar(255) NOT NULL DEFAULT '',
  `art_banner_url` varchar(255) NOT NULL DEFAULT '',
  `art_create_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `art_update_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `art_release_time` int(11) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `art_desc` varchar(255) NOT NULL,
  `art_content` text NOT NULL,
  `art_content_text` text NOT NULL,
  `art_category_id` int(11) NOT NULL DEFAULT '0',
  `art_category_name` varchar(128) NOT NULL DEFAULT '',
  `view_num` int(11) DEFAULT '0',
  `art_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 show 2 hide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `article_tags`
--

CREATE TABLE `article_tags` (
  `article_id` int(11) DEFAULT NULL,
  `tars_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='article 和 tags 关联表';

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(64) NOT NULL,
  `category_sign` varchar(32) NOT NULL,
  `create_at` int(11) NOT NULL DEFAULT '0',
  `update_at` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1 正常 0 删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `links`
--

CREATE TABLE `links` (
  `links_id` int(10) UNSIGNED NOT NULL,
  `link_name` varchar(64) NOT NULL DEFAULT '',
  `link_url` varchar(255) NOT NULL,
  `create_time` int(11) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000000',
  `update_time` int(11) UNSIGNED ZEROFILL DEFAULT '00000000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='友情链接表';

-- --------------------------------------------------------

--
-- 表的结构 `sys_action`
--

CREATE TABLE `sys_action` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '自增ID',
  `controller` varchar(64) NOT NULL COMMENT '控制器',
  `action` varchar(64) NOT NULL COMMENT '动作',
  `name` varchar(64) NOT NULL COMMENT '每个动作的名称',
  `module_id` int(11) UNSIGNED NOT NULL COMMENT '对应的模块id',
  `action_sort` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'action 排序 越大越靠后',
  `is_menu` enum('y','n') NOT NULL DEFAULT 'y' COMMENT '是否是左侧菜单 y是 n 不是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='授权表-controller-action 映射';

--
-- 转存表中的数据 `sys_action`
--

INSERT INTO `sys_action` (`id`, `controller`, `action`, `name`, `module_id`, `action_sort`, `is_menu`) VALUES
(1, 'manage', 'manage_list', '人员列表', 2, 1, 'y'),
(2, 'manage', 'group_list', '用户组列表', 2, 2, 'y'),
(3, 'manage', 'auth_list', '权限管理', 2, 3, 'y'),
(4, 'system', 'base', '基础数据设置', 1, 1, 'y'),
(5, 'article', 'index', '文章管理', 3, 0, 'y'),
(6, 'article', 'art_add', '添加文章', 3, 0, 'y'),
(7, 'article', 'art_edit', '编辑文章', 3, 0, 'n'),
(8, 'article', 'art_del', '删除文章', 3, 0, 'n'),
(9, 'article', 'art_enable_or_disable', '文章状态编辑', 3, 0, 'n'),
(10, 'category', 'index', '分类管理', 4, 0, 'y'),
(11, 'category', 'cat_add', '添加分类', 4, 0, 'y');

-- --------------------------------------------------------

--
-- 表的结构 `sys_config`
--

CREATE TABLE `sys_config` (
  `s_id` int(11) UNSIGNED NOT NULL,
  `k` varchar(255) NOT NULL,
  `v` varchar(255) NOT NULL,
  `type` varchar(16) NOT NULL DEFAULT 'txt',
  `create_at` int(11) DEFAULT '1525593069',
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `sys_config`
--

INSERT INTO `sys_config` (`s_id`, `k`, `v`, `type`, `create_at`, `update_at`) VALUES
(1, 'site_name', 'Cyblog', '', 1525593069, 1526808459),
(2, 'site_keywords', 'cyblog', '', 1525593069, 1525617640),
(3, 'site_description', 'CyblogV1.0.0', '', 1525593069, 1529155398),
(4, 'article_default_banner_url', '/views/default/static/img/default_banner.jpg', '', 1525593069, 1525617623),
(5, 'site_author', 'itzcy<itzcy@itzcy.com>', '', 1525593069, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sys_group`
--

CREATE TABLE `sys_group` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '自增ID',
  `group_name` varchar(64) NOT NULL DEFAULT '' COMMENT '模块名称',
  `group_actions` varchar(2048) NOT NULL DEFAULT '' COMMENT '管理的action 内容',
  `group_remarks` varchar(256) NOT NULL DEFAULT '' COMMENT '备注',
  `group_status` tinyint(255) NOT NULL DEFAULT '1' COMMENT '0 冻结 1 正常'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理模块分组 管理组表';

--
-- 转存表中的数据 `sys_group`
--

INSERT INTO `sys_group` (`id`, `group_name`, `group_actions`, `group_remarks`, `group_status`) VALUES
(1, '超级管理员', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"16\"]', '', 1),
(2, '系统管理员', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"16\"]', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sys_manage`
--

CREATE TABLE `sys_manage` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '自增ID',
  `username` varchar(24) NOT NULL DEFAULT '' COMMENT '后台管理的用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `password_salt` varchar(12) NOT NULL DEFAULT '' COMMENT '密码盐',
  `truename` varchar(32) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `majro` varchar(32) NOT NULL DEFAULT '' COMMENT '专业',
  `telphone` varchar(32) NOT NULL COMMENT '手机号',
  `email` varchar(32) NOT NULL COMMENT '邮箱',
  `auth_group` varchar(64) NOT NULL DEFAULT '0' COMMENT '授权模块(组,group) 关联字段',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `change_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间',
  `administrator` tinyint(11) UNSIGNED DEFAULT '0' COMMENT '0',
  `status` int(11) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否禁用 0:表示禁用；1:表示启用',
  `remarks` varchar(256) NOT NULL DEFAULT '' COMMENT '备注',
  `login_ip` varchar(32) NOT NULL DEFAULT '0' COMMENT '上一次登录ip',
  `login_time` varchar(32) NOT NULL DEFAULT '0' COMMENT '上一次登录时间',
  `login_number` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台管理人员表';

--
-- 转存表中的数据 `sys_manage`
--

INSERT INTO `sys_manage` (`id`, `username`, `password`, `password_salt`, `truename`, `majro`, `telphone`, `email`, `auth_group`, `create_time`, `change_time`, `administrator`, `status`, `remarks`, `login_ip`, `login_time`, `login_number`) VALUES
(1, 'itzcy', '073c3e53ca586eb791d7a9ba99126c1a', '3913', '张辰云', 'Full Stack Developer', '18888888888', 'itzcy@itzcy.com', '[\"1\",\"2\"]', 1, 11, 1, 1, 'asfasfdasfdasdasfasfd', '110.249.168.202', '1574305315', 121);

-- --------------------------------------------------------

--
-- 表的结构 `sys_module`
--

CREATE TABLE `sys_module` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '自增ID',
  `module_name` varchar(64) NOT NULL DEFAULT '' COMMENT '模块名称',
  `module_controller` varchar(64) NOT NULL DEFAULT '',
  `module_iconfount` varchar(64) NOT NULL DEFAULT '',
  `module_sort` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序 越大越靠后'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块归类表';

--
-- 转存表中的数据 `sys_module`
--

INSERT INTO `sys_module` (`id`, `module_name`, `module_controller`, `module_iconfount`, `module_sort`) VALUES
(1, '系统设置', 'system', 'layui-icon-set-fill', 20),
(2, '管理权限设置', 'manage', 'layui-icon-user', 19),
(3, '文章管理', 'article', 'layui-icon-list', 10),
(4, '分类管理', 'category', 'layui-icon-template-1', 11);

-- --------------------------------------------------------

--
-- 表的结构 `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(64) DEFAULT NULL COMMENT 'tag 名称',
  `tag_sign` varchar(32) NOT NULL COMMENT 'tag 标记 url 优化用',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='标签表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`art_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`links_id`);

--
-- Indexes for table `sys_action`
--
ALTER TABLE `sys_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_config`
--
ALTER TABLE `sys_config`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `sys_group`
--
ALTER TABLE `sys_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_manage`
--
ALTER TABLE `sys_manage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_group` (`auth_group`);

--
-- Indexes for table `sys_module`
--
ALTER TABLE `sys_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `i_u_tag_sign` (`tag_sign`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1486;

--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `links`
--
ALTER TABLE `links`
  MODIFY `links_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `sys_action`
--
ALTER TABLE `sys_action`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID', AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `sys_config`
--
ALTER TABLE `sys_config`
  MODIFY `s_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `sys_group`
--
ALTER TABLE `sys_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `sys_manage`
--
ALTER TABLE `sys_manage`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `sys_module`
--
ALTER TABLE `sys_module`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
