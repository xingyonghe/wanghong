/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : wanghong

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-09-26 01:05:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2016_09_21_015708_create_sys_admins_table', '1');
INSERT INTO `migrations` VALUES ('2016_09_22_044928_create_sys_menus_table', '2');
INSERT INTO `migrations` VALUES ('2016_09_24_022506_create_sys_auth_groups_table', '3');
INSERT INTO `migrations` VALUES ('2016_09_24_072156_create_sys_auth_rules_table', '4');

-- ----------------------------
-- Table structure for sys_admin
-- ----------------------------
DROP TABLE IF EXISTS `sys_admin`;
CREATE TABLE `sys_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：-1删除，0禁用，1正常',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '记住我标识',
  `reg_time` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` char(15) NOT NULL DEFAULT '' COMMENT '最后登录ID',
  `role_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_admin_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Records of sys_admin
-- ----------------------------
INSERT INTO `sys_admin` VALUES ('1', 'admin', '$2y$10$oqlb/UzDMuA5.hDN9QByaOkeJcWfUb1CcSU8JTIL1htbfhwNJyJhu', '1', 'eDHDCiN46KN6gz8jWYB1gytmKLJ2C2ChVfvmeOj2Vru8h2yR31ykEXw9H4mE', '2016-09-23 00:18:44', '2016-09-25 11:37:22', '127.0.0.1', '3');
INSERT INTO `sys_admin` VALUES ('2', 'xingyonghe', '$2y$10$IcTAd4v/7ztQTWlOscO0N.2Oor0SzkhIACOF7V3MY4rUQhJPF2/cS', '1', null, '2016-09-25 03:03:53', null, '', '0');
INSERT INTO `sys_admin` VALUES ('3', 'xingyingfeng', '$2y$10$TXhGksJwGBDR80lTxxtezeUcYBJkkhj56m4rHxF83G/mvHa6o6/Oe', '1', '85qgsQutUUs8SnR5hsx5jwfcTOIS50e4fLqOyj3IH1VjnGZvIoJ8fQJAF1oa', '2016-09-25 03:04:29', null, '', '0');
INSERT INTO `sys_admin` VALUES ('4', 'test', '$2y$10$UjmSV1Tcmx46MFW.VJ61BOqC9uWX.xE5Z6Roo1jdGzMSD5yP1k/gG', '1', null, '2016-09-25 11:07:32', null, '', '0');

-- ----------------------------
-- Table structure for sys_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `sys_auth_group`;
CREATE TABLE `sys_auth_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户组状态:0禁用，1正常',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='用户组';

-- ----------------------------
-- Records of sys_auth_group
-- ----------------------------
INSERT INTO `sys_auth_group` VALUES ('1', '测试分组', '用来test的分组', '1', '');
INSERT INTO `sys_auth_group` VALUES ('2', '测试分组2', '用来test的分组2', '1', '');
INSERT INTO `sys_auth_group` VALUES ('3', '测试分组3', '用来test的分组3', '1', '[\"86\",\"77\",\"78\",\"79\",\"80\",\"81\",\"82\",\"83\",\"76\",\"88\",\"89\",\"85\",\"87\",\"74\",\"75\"]');

-- ----------------------------
-- Table structure for sys_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `sys_auth_rule`;
CREATE TABLE `sys_auth_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型:1url，2主菜单',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COMMENT='权限规则';

-- ----------------------------
-- Records of sys_auth_rule
-- ----------------------------
INSERT INTO `sys_auth_rule` VALUES ('74', '菜单管理', 'admin/menu/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('75', '导航管理', 'admin/channel/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('76', '成员管理', 'admin/auth/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('77', '用户组', 'admin/auth/group', '1');
INSERT INTO `sys_auth_rule` VALUES ('78', '用户组授权', 'admin/auth/access', '1');
INSERT INTO `sys_auth_rule` VALUES ('79', '用户组新增', 'admin/auth/addGroup', '1');
INSERT INTO `sys_auth_rule` VALUES ('80', '用户组修改', 'admin/auth/editGroup', '1');
INSERT INTO `sys_auth_rule` VALUES ('81', '用户组更新', 'admin/auth/updateGroup', '1');
INSERT INTO `sys_auth_rule` VALUES ('82', '用户组删除', 'admin/auth/destroyGroup', '1');
INSERT INTO `sys_auth_rule` VALUES ('83', '更新用户组权限', 'admin/auth/updateAccess', '1');
INSERT INTO `sys_auth_rule` VALUES ('84', '首页', 'admin/index/index', '2');
INSERT INTO `sys_auth_rule` VALUES ('85', '用户列表', 'admin/user/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('86', '用户', 'admin/auth/group', '2');
INSERT INTO `sys_auth_rule` VALUES ('87', '系统', 'admin/menu/index', '2');
INSERT INTO `sys_auth_rule` VALUES ('88', '新增成员', 'admin/auth/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('89', '删除成员', 'admin/auth/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('90', '管理员', 'admin/admin/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('91', '新增', 'admin/admin/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('92', '修改', 'admin/admin/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('93', '更新', 'admin/admin/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('94', '删除', 'admin/admin/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('95', '启用', 'admin/admin/resume', '1');
INSERT INTO `sys_auth_rule` VALUES ('96', '禁用', 'admin/admin/forbid', '1');
INSERT INTO `sys_auth_rule` VALUES ('97', '重置密码', 'admin/admin/resetpass', '1');
INSERT INTO `sys_auth_rule` VALUES ('98', '更新密码', 'admin/admin/updatepass', '1');

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否隐藏:0显示，1隐藏',
  `group` varchar(50) NOT NULL DEFAULT '' COMMENT '分组',
  `class` varchar(50) NOT NULL DEFAULT '' COMMENT 'class样式名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COMMENT='系统菜单';

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', '首页', '0', '1', 'admin/index/index', '0', '', 'icon-home');
INSERT INTO `sys_menu` VALUES ('2', '用户', '0', '2', 'admin/auth/group', '0', '', 'icon-user');
INSERT INTO `sys_menu` VALUES ('3', '用户列表', '2', '1', 'admin/user/index', '0', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('4', '系统', '0', '3', 'admin/menu/index', '0', '', 'icon-cogs');
INSERT INTO `sys_menu` VALUES ('5', '菜单管理', '4', '0', 'admin/menu/index', '0', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('6', '导航管理', '4', '0', 'admin/channel/index', '0', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('20', '用户组', '2', '0', 'admin/auth/group', '0', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('21', '用户组授权', '20', '0', 'admin/auth/access', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('23', '用户组新增', '20', '0', 'admin/auth/addGroup', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('24', '用户组修改', '20', '0', 'admin/auth/editGroup', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('25', '用户组更新', '20', '0', 'admin/auth/updateGroup', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('26', '用户组删除', '20', '0', 'admin/auth/destroyGroup', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('27', '更新用户组权限', '20', '0', 'admin/auth/updateAccess', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('28', '成员管理', '20', '0', 'admin/auth/index', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('29', '新增成员', '20', '0', 'admin/auth/add', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('30', '删除成员', '20', '0', 'admin/auth/destroy', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('31', '管理员', '2', '0', 'admin/admin/index', '0', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('32', '新增', '31', '0', 'admin/admin/add', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('33', '修改', '31', '0', 'admin/admin/edit', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('34', '更新', '31', '0', 'admin/admin/update', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('35', '删除', '31', '0', 'admin/admin/destroy', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('36', '启用', '31', '0', 'admin/admin/resume', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('37', '禁用', '31', '0', 'admin/admin/forbid', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('38', '重置密码', '2', '0', 'admin/admin/resetpass', '0', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('39', '更新密码', '38', '0', 'admin/admin/updatepass', '1', '权限管理', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `email` varchar(150) NOT NULL COMMENT '邮箱',
  `mobile` varchar(100) NOT NULL COMMENT '手机号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '用户名',
  `reg_time` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `reg_ip` char(15) NOT NULL COMMENT '注册ID',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` char(15) NOT NULL COMMENT '最后登录ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`),
  UNIQUE KEY `user_mobile_unique` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户基本信息';

-- ----------------------------
-- Records of user
-- ----------------------------