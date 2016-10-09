/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50547
Source Host           : 127.0.0.1:3306
Source Database       : wanghong

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-10-09 22:40:47
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '8');
INSERT INTO `migrations` VALUES ('2016_09_21_015708_create_sys_admins_table', '1');
INSERT INTO `migrations` VALUES ('2016_09_22_044928_create_sys_menus_table', '2');
INSERT INTO `migrations` VALUES ('2016_09_24_022506_create_sys_auth_groups_table', '3');
INSERT INTO `migrations` VALUES ('2016_09_24_072156_create_sys_auth_rules_table', '4');
INSERT INTO `migrations` VALUES ('2016_09_29_122814_create_sys_channels_table', '5');
INSERT INTO `migrations` VALUES ('2016_09_29_172837_create_sys_configs_table', '6');
INSERT INTO `migrations` VALUES ('2016_10_01_221315_create_pictures_table', '7');

-- ----------------------------
-- Table structure for picture
-- ----------------------------
DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='图片表';

-- ----------------------------
-- Records of picture
-- ----------------------------
INSERT INTO `picture` VALUES ('10', '/uploads/picture/2016-10-05/57f3e0875cea5.jpg', '', '4b3e861148ae405179edb35982ecc441', 'a9fdf2f5269fa58c4bff5dfa9725b17569d3dfa4', '2016-10-05 01:01:59');
INSERT INTO `picture` VALUES ('11', '/uploads/picture/2016-10-05/57f3e08e0563f.png', '', 'f0cace382f445e02c550afd6dfc40cdc', '9469f75a2a917f9cc52b76c7eb13de3fd193f59c', '2016-10-05 01:02:06');

-- ----------------------------
-- Table structure for sys_admin
-- ----------------------------
DROP TABLE IF EXISTS `sys_admin`;
CREATE TABLE `sys_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `nickname` varchar(100) NOT NULL COMMENT '昵称',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：-1删除，0禁用，1正常',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '记住我标识',
  `reg_time` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` char(15) NOT NULL DEFAULT '' COMMENT '最后登录ID',
  `role_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Records of sys_admin
-- ----------------------------
INSERT INTO `sys_admin` VALUES ('1', 'admin', '$2y$10$ymrgELHNpTgRrYs6OrJxL.o7/LypgOCT691be6xVRGBfZP8RYnpIm', '超管', '1', 'n2VB20mqvyOuMRzWNvU26jxYRWl8yOtAxFooMKJM5T18t3TC6rQ4h4B9KoYJ', '2016-09-23 00:18:44', '2016-09-29 16:32:19', '127.0.0.1', '1');
INSERT INTO `sys_admin` VALUES ('2', 'xingyonghe', '$2y$10$IcTAd4v/7ztQTWlOscO0N.2Oor0SzkhIACOF7V3MY4rUQhJPF2/cS', '永和', '1', null, '2016-09-25 03:03:53', null, '', '0');
INSERT INTO `sys_admin` VALUES ('3', 'xingyingfeng', '$2y$10$TXhGksJwGBDR80lTxxtezeUcYBJkkhj56m4rHxF83G/mvHa6o6/Oe', '颖楓', '0', '85qgsQutUUs8SnR5hsx5jwfcTOIS50e4fLqOyj3IH1VjnGZvIoJ8fQJAF1oa', '2016-09-25 03:04:29', null, '', '0');
INSERT INTO `sys_admin` VALUES ('4', 'test', '$2y$10$0D3cgZAFIDQf4IKj0yM./eiPCzB12hPz5FKkCoiwyOPZIL9PJLFQK', '测试', '1', 'P5e4Ak2uku02Dq636zEML1G0obSG750SVFqev34rED33LrZFx6pU9GIgbz3f', '2016-09-25 11:07:32', '2016-09-27 12:35:47', '127.0.0.1', '0');
INSERT INTO `sys_admin` VALUES ('6', 'test001', '$2y$10$l/aO1NUM6rFY.LDRr0WkpuGAbZlKXUapDxAPe/crWKxu8T1IFgybC', 'abalabala', '-1', null, '2016-09-28 16:44:37', null, '', '3');
INSERT INTO `sys_admin` VALUES ('7', 'testtest', '$2y$10$JRaN4h7ULBXluHBUoI74WOFDKf42DZp2dFL8D9lS6fHzC2nmIZCci', 'admin', '-1', null, '2016-09-28 17:29:44', null, '', '2');
INSERT INTO `sys_admin` VALUES ('10', 'testtest', '$2y$10$SWovYqCLU2YA83mQvFnkxO5oiA1C4x/ePQen6QE0xu4wpFG13wvL2', 'admin1', '1', null, '2016-09-28 18:01:53', null, '', '3');
INSERT INTO `sys_admin` VALUES ('11', 'testtest', '$2y$10$4uJhRV.bjX9x7jWH4Sg89uReJ9VVCF5Wvvti.kGGDc/W/H6IvD/o2', 'admindd', '1', null, '2016-09-28 18:02:26', null, '', '0');
INSERT INTO `sys_admin` VALUES ('12', 'testtest', '$2y$10$JGm78L.X6l59fueDt38Y2e6/0VjgYCu.GQY.HaoytC5tWlQ14JKwS', 'adminsss', '1', null, '2016-09-28 18:02:48', null, '', '0');
INSERT INTO `sys_admin` VALUES ('13', 'testtest1', '$2y$10$olt3DAd1qXp53J4IjbkIu.A0Z9Q7dtlo91n6vqItTyjZoZY8yGphK', 'adminsd', '1', null, '2016-09-28 18:20:25', null, '', '3');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='用户组';

-- ----------------------------
-- Records of sys_auth_group
-- ----------------------------
INSERT INTO `sys_auth_group` VALUES ('1', '超级管理员', '拥有网站所有权限', '1', '[\"84\",\"86\",\"77\",\"78\",\"79\",\"80\",\"81\",\"82\",\"83\",\"76\",\"88\",\"89\",\"90\",\"91\",\"92\",\"93\",\"94\",\"95\",\"96\",\"103\",\"97\",\"98\",\"85\",\"87\",\"74\",\"99\",\"100\",\"101\",\"102\",\"75\",\"104\",\"105\",\"106\",\"107\",\"108\",\"109\",\"112\",\"113\",\"110\",\"114\",\"115\",\"111\",\"116\"]');
INSERT INTO `sys_auth_group` VALUES ('2', '测试分组2', '用来test的分组2', '1', '');
INSERT INTO `sys_auth_group` VALUES ('3', '测试分组3', '用来test的分组3', '1', '[\"84\",\"86\",\"77\",\"78\",\"80\",\"81\",\"82\",\"83\",\"76\",\"88\",\"89\",\"90\",\"91\",\"92\",\"93\",\"94\",\"95\",\"96\",\"97\",\"98\",\"85\",\"87\",\"74\",\"99\",\"100\",\"101\",\"102\",\"75\"]');

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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COMMENT='权限规则';

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
INSERT INTO `sys_auth_rule` VALUES ('83', '更新用户组权限', 'admin/auth/writeGroup', '1');
INSERT INTO `sys_auth_rule` VALUES ('84', '首页', 'admin/index/index', '2');
INSERT INTO `sys_auth_rule` VALUES ('85', '用户列表', 'admin/user/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('86', '用户', 'admin/auth/group', '2');
INSERT INTO `sys_auth_rule` VALUES ('87', '系统', 'admin/menu/index', '2');
INSERT INTO `sys_auth_rule` VALUES ('88', '新增成员', 'admin/auth/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('89', '删除成员', 'admin/auth/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('90', '管理员', 'admin/admin/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('91', '新增', 'admin/admin/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('92', '编辑', 'admin/admin/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('93', '添加', 'admin/admin/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('94', '删除', 'admin/admin/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('95', '启用', 'admin/admin/resume', '1');
INSERT INTO `sys_auth_rule` VALUES ('96', '禁用', 'admin/admin/forbid', '1');
INSERT INTO `sys_auth_rule` VALUES ('97', '重置密码', 'admin/admin/resetpass', '1');
INSERT INTO `sys_auth_rule` VALUES ('98', '更新密码', 'admin/admin/updatepass', '1');
INSERT INTO `sys_auth_rule` VALUES ('99', '新增', 'admin/menu/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('100', '编辑', 'admin/menu/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('101', '更新', 'admin/menu/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('102', '删除', 'admin/menu/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('103', '修改', 'admin/admin/editUpdate', '1');
INSERT INTO `sys_auth_rule` VALUES ('104', '新增', 'admin/channel/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('105', '编辑', 'admin/channel/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('106', '更新', 'admin/channel/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('107', '删除', 'admin/channel/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('108', '排序', 'admin/channel/sort', '1');
INSERT INTO `sys_auth_rule` VALUES ('109', '更新排序', 'admin/channel/postSort', '1');
INSERT INTO `sys_auth_rule` VALUES ('110', '网站配置', 'admin/config/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('111', '更新', 'admin/config/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('112', '网站设置', 'admin/config/setting', '1');
INSERT INTO `sys_auth_rule` VALUES ('113', '更新设置', 'admin/config/post', '1');
INSERT INTO `sys_auth_rule` VALUES ('114', '新增', 'admin/config/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('115', '编辑', 'admin/config/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('116', '删除', 'admin/config/destroy', '1');

-- ----------------------------
-- Table structure for sys_channel
-- ----------------------------
DROP TABLE IF EXISTS `sys_channel`;
CREATE TABLE `sys_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '导航标题',
  `url` varchar(150) NOT NULL COMMENT '导航链接',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否隐藏:1显示，0隐藏',
  `target` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否新窗口打开:0否，1是',
  `remark` varchar(150) NOT NULL COMMENT '导航备注',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='导航';

-- ----------------------------
-- Records of sys_channel
-- ----------------------------
INSERT INTO `sys_channel` VALUES ('1', '活动订单', 'home/order/index', '5', '1', '0', '', '2016-09-29 13:22:15', '2016-09-29 15:33:54');
INSERT INTO `sys_channel` VALUES ('2', '资源管理', 'home/resource/index', '4', '1', '0', '', '2016-09-29 13:22:42', '2016-09-29 15:33:54');
INSERT INTO `sys_channel` VALUES ('3', '派单大厅', 'home/order/index', '2', '1', '0', '', '2016-09-29 13:23:25', '2016-09-29 15:34:15');
INSERT INTO `sys_channel` VALUES ('4', '账单查询', 'home/account/index', '3', '1', '0', '', '2016-09-29 13:23:56', '2016-09-29 15:34:15');
INSERT INTO `sys_channel` VALUES ('5', '个人中心', 'member/index/index', '6', '1', '0', '', '2016-09-29 13:24:21', '2016-09-29 15:34:15');
INSERT INTO `sys_channel` VALUES ('6', '首页', 'home/index/index', '1', '1', '0', '', '2016-09-29 13:25:22', '2016-09-29 15:34:15');

-- ----------------------------
-- Table structure for sys_config
-- ----------------------------
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE `sys_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '配置类型:0数字，1字符，2文本，3数组，4枚举，5图片',
  `group` tinyint(4) NOT NULL DEFAULT '0' COMMENT '配置分组:0基本设置，1SEO优化',
  `value` varchar(300) NOT NULL DEFAULT '' COMMENT '配置值',
  `extra` varchar(300) NOT NULL DEFAULT '' COMMENT '配置项',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '配置说明',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='网站配置';

-- ----------------------------
-- Records of sys_config
-- ----------------------------
INSERT INTO `sys_config` VALUES ('1', '网站标题', 'WEB_SITE_TITLE', '0', '2', '2', '网红广告网', '', '网站标题前台显示标题', '2016-09-30 00:12:13', '2016-10-01 10:07:48');
INSERT INTO `sys_config` VALUES ('2', '网站关键字', 'WEB_SITE_KEYWORD', '0', '3', '2', '网红、广告', '', '网站搜索引擎关键字', '2016-09-30 00:24:28', '2016-10-01 10:07:35');
INSERT INTO `sys_config` VALUES ('3', '网站描述', 'WEB_SITE_DESCRIPTION', '0', '3', '2', '网红广告平台', '', '网站搜索引擎描述', '2016-09-30 00:25:13', '2016-10-01 10:07:25');
INSERT INTO `sys_config` VALUES ('4', '配置类型列表', 'CONFIG_TYPE_LIST', '0', '3', '1', '1:数字\r\n2:字符\r\n3:文本\r\n4:枚举\r\n5:图片', '', '主要用于数据解析和页面表单的生成', '2016-09-30 00:27:00', '2016-10-05 10:50:57');
INSERT INTO `sys_config` VALUES ('5', '配置分组', 'CONFIG_GROUP_LIST', '0', '3', '1', '1:基本\r\n2:系统\r\n3:内容\r\n4:用户', '', '配置分组', '2016-09-30 00:28:32', '2016-10-05 10:50:48');
INSERT INTO `sys_config` VALUES ('6', '网站LOGO', 'WEB_SITE_LOGO', '0', '5', '2', '11', '', '', '2016-10-01 07:56:17', '2016-10-05 09:27:19');
INSERT INTO `sys_config` VALUES ('7', '网站域名地址', 'WEB_SITE_URL', '0', '2', '2', 'http://www.wanghong.com', '', '', '2016-10-01 07:57:07', '2016-10-01 10:06:22');
INSERT INTO `sys_config` VALUES ('8', '允许广告主注册', 'WEB_REGISTER_AD', '0', '4', '4', '1', '0:否\r\n1:是', '', '2016-10-05 10:18:12', '2016-10-05 10:50:33');
INSERT INTO `sys_config` VALUES ('9', '允许普通会员注册', 'WEB_REGISTER_USER', '0', '4', '4', '1', '0:否\r\n1:是', '', '2016-10-05 10:20:20', '2016-10-05 10:52:11');
INSERT INTO `sys_config` VALUES ('10', '注册是否需要审核', 'WEB_REGISTER_VERIFY', '0', '4', '4', '0', '0:否\r\n1:是', '', '2016-10-05 10:27:38', '2016-10-05 10:50:18');
INSERT INTO `sys_config` VALUES ('11', '媒体是否审核', 'USER_MEDIA_VERIFY', '0', '4', '4', '0', '0:否\r\n1:是', '', '2016-10-05 10:30:03', '2016-10-05 11:21:28');

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
  `icon` varchar(50) NOT NULL DEFAULT '' COMMENT 'class样式名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COMMENT='系统菜单';

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
INSERT INTO `sys_menu` VALUES ('27', '更新用户组权限', '20', '0', 'admin/auth/writeGroup', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('28', '成员管理', '20', '0', 'admin/auth/index', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('29', '新增成员', '20', '0', 'admin/auth/add', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('30', '删除成员', '20', '0', 'admin/auth/destroy', '1', '权限设置', '');
INSERT INTO `sys_menu` VALUES ('31', '管理员', '2', '0', 'admin/admin/index', '0', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('32', '新增', '31', '0', 'admin/admin/add', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('33', '编辑', '31', '0', 'admin/admin/edit', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('34', '添加', '31', '0', 'admin/admin/update', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('35', '删除', '31', '0', 'admin/admin/destroy', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('36', '启用', '31', '0', 'admin/admin/resume', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('37', '禁用', '31', '0', 'admin/admin/forbid', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('38', '重置密码', '2', '0', 'admin/admin/resetpass', '0', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('39', '更新密码', '38', '0', 'admin/admin/updatepass', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('40', '新增', '5', '0', 'admin/menu/add', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('41', '编辑', '5', '0', 'admin/menu/edit', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('42', '更新', '5', '0', 'admin/menu/update', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('43', '删除', '5', '0', 'admin/menu/destroy', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('44', '修改', '31', '0', 'admin/admin/editUpdate', '1', '权限管理', '');
INSERT INTO `sys_menu` VALUES ('45', '新增', '6', '0', 'admin/channel/add', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('46', '编辑', '6', '0', 'admin/channel/edit', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('47', '更新', '6', '0', 'admin/channel/update', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('48', '删除', '6', '0', 'admin/channel/destroy', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('49', '排序', '6', '0', 'admin/channel/sort', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('50', '更新排序', '6', '0', 'admin/channel/postSort', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('51', '网站设置', '4', '0', 'admin/config/setting', '0', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('52', '更新设置', '51', '0', 'admin/config/post', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('53', '网站配置', '4', '0', 'admin/config/index', '0', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('54', '新增', '53', '0', 'admin/config/add', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('55', '编辑', '53', '0', 'admin/config/edit', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('56', '更新', '53', '0', 'admin/config/update', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('57', '删除', '53', '0', 'admin/config/destroy', '1', '系统设置', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名:手机号',
  `is_auth` tinyint(4) NOT NULL DEFAULT '0' COMMENT '手机号是否认证通过:1已认证，0未认证',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户类型:1普通2广告主',
  `nickname` varchar(100) NOT NULL COMMENT '联系人',
  `qq` varchar(20) NOT NULL COMMENT 'QQ',
  `weixin` varchar(150) NOT NULL COMMENT '微信',
  `freeze` decimal(10,2) NOT NULL COMMENT '冻结金额',
  `balance` decimal(10,2) NOT NULL COMMENT '余额',
  `wait_account` decimal(10,2) NOT NULL COMMENT '待结算金额',
  `finish_account` decimal(10,2) NOT NULL COMMENT '已结算金额',
  `custom_id` int(11) NOT NULL DEFAULT '0' COMMENT '客服ID',
  `custom_name` varchar(150) NOT NULL DEFAULT '' COMMENT '客服名称',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:-1删除、0锁定、1正常、2待审核',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '记住我',
  `reg_time` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `reg_ip` varchar(45) NOT NULL COMMENT '注册IP',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(45) NOT NULL COMMENT '最后登录IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户基本信息';

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for user_ads
-- ----------------------------
DROP TABLE IF EXISTS `user_ads`;
CREATE TABLE `user_ads` (
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `company` varchar(255) NOT NULL COMMENT '公司名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='广告主用户扩展信息';

-- ----------------------------
-- Records of user_ads
-- ----------------------------

-- ----------------------------
-- Table structure for user_personal
-- ----------------------------
DROP TABLE IF EXISTS `user_personal`;
CREATE TABLE `user_personal` (
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `medias` int(11) NOT NULL COMMENT '媒体资源数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='普通用户扩展信息';

-- ----------------------------
-- Records of user_personal
-- ----------------------------
