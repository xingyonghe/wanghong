/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : wanghong

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-11-02 17:24:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `catid` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `descrition` varchar(300) NOT NULL DEFAULT '' COMMENT '描述',
  `view` int(11) NOT NULL DEFAULT '0' COMMENT '浏览',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者',
  `quote` varchar(255) NOT NULL DEFAULT '' COMMENT '来源',
  `content` text NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:-1删除、0锁定、1正常',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='文章';

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.', '6', '扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.扫描二维码登录微信. ', '0', '星澭和', '新闻网', '<p><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"background-color: rgb(255, 255, 255); color: rgb(51, 51, 51); font-family: arial; font-size: 13px;\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span><span style=\"color: rgb(51, 51, 51); font-family: arial; font-size: 13px; background-color: rgb(255, 255, 255);\">扫描二维码登录微信. 登录手机微信. 手机上安装并登录微信.</span></p>', '1', '2016-10-16 23:46:16', '2016-11-01 16:30:35');
INSERT INTO `article` VALUES ('2', '很多网站首页都有一片文章的一小部分.在这里就要使用strip_tags()', '5', '很多网站首页都有一片文章的一小部分.在这里就要使用strip_tags()把html标签去除掉.但但是汉字的话我们还要考虑是什么编码，因为正常切割字段串很容易把最后一个汉字切成一半.很多网站首页都有一片文章的一小部分.在这里就要使用strip_tags()把html标签去除掉.但但是汉字的话我们还要考虑是什么编码，因为正常切割字段串很容易把最后一个汉字切成一半.很多网站首页都有一片文章的一小部分....', '0', '速度', '嘻嘻嘻', '<p><span style=\"color: rgb(157, 122, 58); font-family: \">很多网站首页都有一片文章的一小部分.在这里就要使用strip_tags()把html标签去除掉.但但是汉字的话我们还要考虑是什么编码，因为正常切割字段串很容易把最后一个汉字切成一半.</span><span style=\"color: rgb(157, 122, 58); font-family: \">很多网站首页都有一片文章的一小部分.在这里就要使用strip_tags()把html标签去除掉.但但是汉字的话我们还要考虑是什么编码，因为正常切割字段串很容易把最后一个汉字切成一半.</span><span style=\"color: rgb(157, 122, 58); font-family: \">很多网站首页都有一片文章的一小部分.在这里就要使用strip_tags()把html标签去除掉.但但是汉字的话我们还要考虑是什么编码，因为正常切割字段串很容易把最后一个汉字切成一半.</span><span style=\"color: rgb(157, 122, 58); font-family: \">很多网站首页都有一片文章的一小部分.在这里就要使用strip_tags()把html标签去除掉.但但是汉字的话我们还要考虑是什么编码，因为正常切割字段串很容易把最后一个汉字切成一半.</span><span style=\"color: rgb(157, 122, 58); font-family: \">很多网站首页都有一片文章的一小部分.在这里就要使用strip_tags()把html标签去除掉.但但是汉字的话我们还要考虑是什么编码，因为正常切割字段串很容易把最后一个汉字切成一半.</span></p>', '1', '2016-10-16 23:50:07', '2016-11-01 16:30:29');
INSERT INTO `article` VALUES ('3', 'PHP中过滤html标签  似的发射点犯得上', '6', 'UEditor 是由百度「FEX前端研发团队」开发的所见即所得富文本web编辑器，具有轻量，可定制，注重用户体验等特点，开源基于MIT协议，允许自由使用和修改代码。UEditor 是由百度「FEX前端研发团队」开发的所见即所得富文本web编辑器，具有轻量，可定制，注重用户体验等特点，开源基于MIT协...', '0', '地方撒', '嘻嘻嘻', '<p><span style=\"color: rgb(51, 51, 51); font-family: \">UEditor 是由百度「FEX前端研发团队」开发的所见即所得富文本web编辑器，具有轻量，可定制，注重用户体验等特点，开源基于MIT协议，允许自由使用和修改代码。</span><span style=\"color: rgb(51, 51, 51); font-family: \">UEditor 是由百度「FEX前端研发团队」开发的所见即所得富文本web编辑器，具有轻量，可定制，注重用户体验等特点，开源基于MIT协议，允许自由使用和修改代码。</span><span style=\"color: rgb(51, 51, 51); font-family: \">UEditor 是由百度「FEX前端研发团队」开发的所见即所得富文本web编辑器，具有轻量，可定制，注重用户体验等特点，开源基于MIT协议，允许自由使用和修改代码。</span><span style=\"color: rgb(51, 51, 51); font-family: \">UEditor 是由百度「FEX前端研发团队」开发的所见即所得富文本web编辑器，具有轻量，可定制，注重用户体验等特点，开源基于MIT协议，允许自由使用和修改代码。</span><span style=\"color: rgb(51, 51, 51); font-family: \">UEditor 是由百度「FEX前端研发团队」开发的所见即所得富文本web编辑器，具有轻量，可定制，注重用户体验等特点，开源基于MIT协议，允许自由使用和修改代码。手动阀手动阀士大夫舒服撒地方士大夫撒旦发生大31231231</span></p>', '1', '2016-10-16 23:54:03', '2016-11-01 16:30:23');
INSERT INTO `article` VALUES ('5', 'laravel吐槽系列之一', '5', '最近项目中经常使用到了laravel框架，对于这个框架之前只是弱弱地接触了一点，没有深入接触，这下有时间好好研究它了（主要是不得不研究了）。说实话，laravel让我打开眼界了，之前对框架的使用一直停留在yii1.X阶段。总之那句话说的对，刚接触laravel的phper就只有两个反应，一个是捡到宝...', '0', '叶剑峰', '轩脉刃de刀光剑影', '<p><span style=\"color: rgb(51, 51, 51); font-family: Georgia, \">最近项目中经常使用到了laravel框架，对于这个框架之前只是弱弱地接触了一点，没有深入接触，这下有时间好好研究它了（主要是不得不研究了）。说实话，laravel让我打开眼界了，之前对框架的使用一直停留在yii1.X阶段。总之那句话说的对，刚接触laravel的phper就只有两个反应，一个是捡到宝了，一个是觉得它是垃圾。我能，就属于后者，所以现在在努力让自己爱上laravel。但是一切总是有那么硌人的地方，我就想写写一些东西来吐槽laravel。</span><br/></p><p>一共有28个需要Install的，这个导致的结果是初始化可运行的项目大小有25M之大。</p><p>这么bigger than bigger的玩意，首先会带来部署上的不便利。</p><p>部署laravel项目的时候会有两种方式，一种是只发布除了vendor之外的项目相关的文件，然后运行composer进行vender的更新，另外一种是直接将vendor进入版本库，使用版本库的发布将所有代码发布到线上机器去。我个人倾向第二种，能把代码库中的文件直接放到服务器上就能运行的多牛逼。但是这样子，代码库就变得超大了，不大便利了。</p><p>&nbsp;</p><p>其次，这么多的vendor导致的是文档查阅的不方便。</p><p>一个框架好用不好用，文档是一个至关重要的环节。但是引用的第三方库一多了，很多使用文档官方就没有足够详细的文档说明了，然后美其名告诉你，这个是引用第三方库的，给你个链接，你去第三方库的说明文档中看把。但是你要知道，在开发过程中，文档是需要有统一性的，每一个说明文档的展示和查询规则都是有惯性的。你给个链接让我去一个不一样布局的网页，我的思维还需要进行跳跃和查找。</p><p><br/></p>', '1', '2016-10-21 15:32:04', '2016-11-01 16:30:17');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `model` varchar(30) NOT NULL DEFAULT '' COMMENT '模块分组',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='分类';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('5', '新闻活动', '0', '0', 'article', '2016-11-01 16:29:56', '2016-11-01 16:29:56');
INSERT INTO `category` VALUES ('6', '网站公告', '0', '0', 'article', '2016-11-01 16:30:07', '2016-11-01 16:30:07');

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '所属会员ID',
  `avatar` int(11) NOT NULL DEFAULT '0' COMMENT '头像',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '资源类别:1直播、2短视频',
  `platform` varchar(100) NOT NULL DEFAULT '' COMMENT '直播平台',
  `form_money` varchar(150) NOT NULL DEFAULT '' COMMENT '展现形式及报价',
  `homepage` varchar(255) NOT NULL DEFAULT '' COMMENT '平台ID',
  `room_id` varchar(255) NOT NULL DEFAULT '' COMMENT '房间号',
  `manner` varchar(255) NOT NULL DEFAULT '' COMMENT '主播风格',
  `fan` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝数',
  `online` int(11) NOT NULL DEFAULT '0' COMMENT '直播平均人数',
  `bespeak` int(11) NOT NULL DEFAULT '0' COMMENT '预约次数',
  `accept` int(11) NOT NULL DEFAULT '0' COMMENT '接单数',
  `refuse` int(11) NOT NULL DEFAULT '0' COMMENT '拒单数',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '媒体等级',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:-1删除、0锁定、1正常、2待审核、3未通过',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='资源媒体';

-- ----------------------------
-- Records of media
-- ----------------------------
INSERT INTO `media` VALUES ('1', '小红桃', '21', '20', '1', '战旗', '线下活动：50000\r\n在线直播：100000', 'xiao_hongtao', '38', '风趣，幽默', '2500', '2000', '0', '0', '0', '0', '1', '2016-11-01 17:16:02', '2016-11-02 14:58:50');
INSERT INTO `media` VALUES ('2', '小颖桃', '21', '20', '1', '战旗', '线下活动：50000\r\n在线直播：100000', 'xiao_yingtao', '38', '风趣，幽默，帅哥', '2500', '2000', '0', '0', '0', '0', '1', '2016-11-01 17:22:46', '2016-11-02 14:58:46');
INSERT INTO `media` VALUES ('3', '小颖桃', '21', '20', '1', '战旗', '线下活动：50000\r\n在线直播：100000', 'xiao_yingtao', '38', '风趣，幽默，帅哥', '2500', '2000', '0', '0', '0', '0', '1', '2016-11-01 17:23:17', '2016-11-02 14:49:38');
INSERT INTO `media` VALUES ('4', '小颖桃', '21', '20', '1', '战旗', '线下活动：50000\r\n在线直播：100000', 'xiao_yingtao', '38', '风趣，幽默，帅哥', '2500', '2000', '0', '0', '0', '0', '1', '2016-11-01 17:25:24', '2016-11-02 14:23:17');
INSERT INTO `media` VALUES ('5', '小颖桃', '21', '20', '1', '手动阀', '线下活动：50000\r\n在线直播：100000', 'xiao_yingtao', '38', '风趣，幽默，帅哥', '2500', '2000', '0', '0', '0', '0', '1', '2016-11-01 17:25:33', '2016-11-02 13:57:00');
INSERT INTO `media` VALUES ('6', '小颖桃', '21', '20', '1', '撒地方', '线下活动：50000\r\n在线直播：100000', 'xiao_yingtao', '38', '风趣，幽默，帅哥', '2500', '2000', '0', '0', '0', '0', '1', '2016-11-01 17:26:17', '2016-11-02 14:58:33');
INSERT INTO `media` VALUES ('7', '小颖桃', '21', '20', '2', '熊猫', '线下活动：50000\r\n在线直播：100000', 'xiao_yingtao', '38', '风趣，幽默，帅哥', '2500', '2000', '0', '0', '0', '0', '1', '2016-11-02 11:42:41', '2016-11-02 14:49:04');

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
INSERT INTO `migrations` VALUES ('2016_10_15_173339_create_categories_table', '9');
INSERT INTO `migrations` VALUES ('2016_10_15_173404_create_articles_table', '10');
INSERT INTO `migrations` VALUES ('2016_10_29_175718_create_media_table', '11');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COMMENT='图片表';

-- ----------------------------
-- Records of picture
-- ----------------------------
INSERT INTO `picture` VALUES ('10', '/uploads/picture/2016-10-05/57f3e0875cea5.jpg', '', '4b3e861148ae405179edb35982ecc441', 'a9fdf2f5269fa58c4bff5dfa9725b17569d3dfa4', '2016-10-05 01:01:59');
INSERT INTO `picture` VALUES ('11', '/uploads/picture/2016-10-05/57f3e08e0563f.png', '', 'f0cace382f445e02c550afd6dfc40cdc', '9469f75a2a917f9cc52b76c7eb13de3fd193f59c', '2016-10-05 01:02:06');
INSERT INTO `picture` VALUES ('19', '/uploads/avatar/5814714dbb58f.jpg', '', 'eaf504f99d186f97f41477dcfb61d4bf', '417443ca9967f82b4a8fc2f21f5dd4a40bc3c39f', '2016-10-29 17:52:14');
INSERT INTO `picture` VALUES ('20', '/uploads/avatar/58185bc5a4671.png', '', '3425819e5aa909bb637fbbafa6433285', 'fbd46ccbabdc1dfb1e5fe86026d0780fbc34f6a4', '2016-11-01 17:09:26');
INSERT INTO `picture` VALUES ('21', '/uploads/avatar/581990abab2a1.png', '', '270ed5cc808b5314bc3e89201617efff', '1aaf741753ca12a924a469f0f4a9ebde1299166c', '2016-11-02 15:07:24');

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
INSERT INTO `sys_admin` VALUES ('1', 'admin', '$2y$10$ymrgELHNpTgRrYs6OrJxL.o7/LypgOCT691be6xVRGBfZP8RYnpIm', '超管', '1', 'qndL4VizAsqdDvWBKPnPFiH68cW4SU0FTLccas7Gex4cZ9JoYXhNGSivF8JV', '2016-09-23 00:18:44', '2016-11-01 16:37:47', '127.0.0.1', '1');
INSERT INTO `sys_admin` VALUES ('2', 'xingyonghe', '$2y$10$IcTAd4v/7ztQTWlOscO0N.2Oor0SzkhIACOF7V3MY4rUQhJPF2/cS', '永和', '1', null, '2016-09-25 03:03:53', null, '', '0');
INSERT INTO `sys_admin` VALUES ('3', 'xingyingfeng', '$2y$10$TXhGksJwGBDR80lTxxtezeUcYBJkkhj56m4rHxF83G/mvHa6o6/Oe', '颖楓', '0', '85qgsQutUUs8SnR5hsx5jwfcTOIS50e4fLqOyj3IH1VjnGZvIoJ8fQJAF1oa', '2016-09-25 03:04:29', null, '', '0');

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
INSERT INTO `sys_auth_group` VALUES ('1', '超级管理员', '拥有网站所有权限', '1', '[\"84\",\"86\",\"77\",\"78\",\"79\",\"80\",\"81\",\"82\",\"83\",\"76\",\"88\",\"89\",\"90\",\"91\",\"92\",\"93\",\"94\",\"95\",\"96\",\"103\",\"97\",\"98\",\"126\",\"117\",\"118\",\"119\",\"120\",\"121\",\"122\",\"123\",\"135\",\"136\",\"137\",\"127\",\"128\",\"129\",\"130\",\"131\",\"132\",\"133\",\"134\",\"138\",\"139\",\"140\",\"141\",\"143\",\"144\",\"145\",\"146\",\"142\",\"152\",\"153\",\"154\",\"155\",\"87\",\"74\",\"99\",\"100\",\"101\",\"102\",\"124\",\"125\",\"75\",\"104\",\"105\",\"106\",\"107\",\"108\",\"109\",\"112\",\"113\",\"110\",\"114\",\"115\",\"111\",\"116\"]');
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
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COMMENT='权限规则';

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
INSERT INTO `sys_auth_rule` VALUES ('117', '添加', 'admin/personal/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('118', '编辑', 'admin/personal/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('119', '更新', 'admin/personal/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('120', '删除', 'admin/personal/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('121', '禁用', 'admin/personal/forbid', '1');
INSERT INTO `sys_auth_rule` VALUES ('122', '启用', 'admin/personal/resume', '1');
INSERT INTO `sys_auth_rule` VALUES ('123', '审核', 'admin/personal/verify', '1');
INSERT INTO `sys_auth_rule` VALUES ('124', '批量新增', 'admin/menu/batch', '1');
INSERT INTO `sys_auth_rule` VALUES ('125', '批量更新', 'admin/menu/batchUpdate', '1');
INSERT INTO `sys_auth_rule` VALUES ('126', '用户列表', 'admin/personal/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('127', '广告主', 'admin/advertiser/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('128', '添加', 'admin/advertiser/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('129', '编辑', 'admin/advertiser/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('130', '新增', 'admin/advertiser/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('131', '删除', 'admin/advertiser/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('132', '禁用', 'admin/advertiser/forbid', '1');
INSERT INTO `sys_auth_rule` VALUES ('133', '启用', 'admin/advertiser/resume', '1');
INSERT INTO `sys_auth_rule` VALUES ('134', '审核', 'admin/advertiser/verify', '1');
INSERT INTO `sys_auth_rule` VALUES ('135', '新增', 'admin/personal/post', '1');
INSERT INTO `sys_auth_rule` VALUES ('136', '添加客服', 'admin/personal/addCustom', '1');
INSERT INTO `sys_auth_rule` VALUES ('137', '更新客服', 'admin/personal/postCustom', '1');
INSERT INTO `sys_auth_rule` VALUES ('138', '更新', 'admin/advertiser/post', '1');
INSERT INTO `sys_auth_rule` VALUES ('139', '添加客服', 'admin/advertiser/addCustom', '1');
INSERT INTO `sys_auth_rule` VALUES ('140', '更新客服', 'admin/advertiser/postCustom', '1');
INSERT INTO `sys_auth_rule` VALUES ('141', '分类管理', 'admin/article/category', '1');
INSERT INTO `sys_auth_rule` VALUES ('142', '内容列表', 'admin/article/index', '1');
INSERT INTO `sys_auth_rule` VALUES ('143', '新增', 'admin/category/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('144', '编辑', 'admin/category/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('145', '删除', 'admin/category/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('146', '更新', 'admin/category/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('152', '新增', 'admin/article/add', '1');
INSERT INTO `sys_auth_rule` VALUES ('153', '编辑', 'admin/article/edit', '1');
INSERT INTO `sys_auth_rule` VALUES ('154', '删除', 'admin/article/destroy', '1');
INSERT INTO `sys_auth_rule` VALUES ('155', '更新', 'admin/article/update', '1');
INSERT INTO `sys_auth_rule` VALUES ('156', '内容', 'admin/article/index', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='网站配置';

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
INSERT INTO `sys_config` VALUES ('8', '允许广告主注册', 'WEB_REGISTER_AD', '0', '4', '4', '1', '0:不允许\r\n1:允许', '', '2016-10-05 10:18:12', '2016-10-27 13:56:20');
INSERT INTO `sys_config` VALUES ('9', '允许普通会员注册', 'WEB_REGISTER_USER', '0', '4', '4', '1', '0:不允许\r\n1:允许', '', '2016-10-05 10:20:20', '2016-10-27 13:56:04');
INSERT INTO `sys_config` VALUES ('10', '注册是否需要审核', 'WEB_REGISTER_VERIFY', '0', '4', '4', '1', '0:不需要\r\n1:需要', '', '2016-10-05 10:27:38', '2016-10-27 13:55:49');
INSERT INTO `sys_config` VALUES ('11', '新增媒体是否需要审核', 'USER_MEDIA_VERIFY', '0', '4', '4', '1', '0:不需要\r\n1:需要', '', '2016-10-05 10:30:03', '2016-11-01 17:23:11');
INSERT INTO `sys_config` VALUES ('12', '网红资源名称', 'USER_MEDIA_TYPE', '0', '3', '4', '\'\':请选择\r\n斗鱼:斗鱼\r\n虎牙:虎牙\r\n战旗:战旗\r\n熊猫:熊猫\r\n花椒:花椒\r\nYY:YY\r\n一直被:一直被\r\n映客:映客\r\n战旗:战旗\r\n龙珠:龙珠\r\n全民TV:全民TV\r\n163CC:163CC\r\n火星:火星\r\n繁星:繁星', '', '', '2016-10-29 14:43:00', '2016-11-01 17:07:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COMMENT='系统菜单';

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', '首页', '0', '1', 'admin/index/index', '0', '', 'icon-home');
INSERT INTO `sys_menu` VALUES ('2', '用户', '0', '2', 'admin/auth/group', '0', '', 'icon-user');
INSERT INTO `sys_menu` VALUES ('3', '用户列表', '2', '1', 'admin/personal/index', '0', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('4', '系统', '0', '8', 'admin/menu/index', '0', '', 'icon-cogs');
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
INSERT INTO `sys_menu` VALUES ('58', '广告主', '2', '2', 'admin/advertiser/index', '0', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('59', '添加', '3', '0', 'admin/personal/add', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('60', '编辑', '3', '0', 'admin/personal/edit', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('61', '更新', '3', '0', 'admin/personal/update', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('62', '删除', '3', '0', 'admin/personal/destroy', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('63', '禁用', '3', '0', 'admin/personal/forbid', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('64', '启用', '3', '0', 'admin/personal/resume', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('65', '审核', '3', '0', 'admin/personal/verify', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('66', '批量新增', '5', '0', 'admin/menu/batch', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('67', '批量更新', '5', '0', 'admin/menu/batchUpdate', '1', '系统设置', '');
INSERT INTO `sys_menu` VALUES ('68', '添加', '58', '0', 'admin/advertiser/add', '1', '用户管理 ', '');
INSERT INTO `sys_menu` VALUES ('69', '编辑', '58', '0', 'admin/advertiser/edit', '1', '用户管理 ', '');
INSERT INTO `sys_menu` VALUES ('70', '新增', '58', '0', 'admin/advertiser/update', '1', '用户管理 ', '');
INSERT INTO `sys_menu` VALUES ('71', '删除', '58', '0', 'admin/advertiser/destroy', '1', '用户管理 ', '');
INSERT INTO `sys_menu` VALUES ('72', '禁用', '58', '0', 'admin/advertiser/forbid', '1', '用户管理 ', '');
INSERT INTO `sys_menu` VALUES ('73', '启用', '58', '0', 'admin/advertiser/resume', '1', '用户管理 ', '');
INSERT INTO `sys_menu` VALUES ('74', '审核', '58', '0', 'admin/advertiser/verify', '1', '用户管理 ', '');
INSERT INTO `sys_menu` VALUES ('75', '新增', '3', '0', 'admin/personal/post', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('76', '添加客服', '3', '0', 'admin/personal/addCustom', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('77', '更新客服', '3', '0', 'admin/personal/postCustom', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('78', '更新', '58', '0', 'admin/advertiser/post', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('79', '添加客服', '58', '0', 'admin/advertiser/addCustom', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('80', '更新客服', '58', '0', 'admin/advertiser/postCustom', '1', '用户管理', '');
INSERT INTO `sys_menu` VALUES ('81', '内容', '0', '3', 'admin/article/index', '0', '', 'icon-file-text-alt');
INSERT INTO `sys_menu` VALUES ('82', '分类管理', '81', '0', 'admin/article/category', '0', '模块管理', '');
INSERT INTO `sys_menu` VALUES ('83', '内容列表', '81', '0', 'admin/article/index', '0', '内容管理', '');
INSERT INTO `sys_menu` VALUES ('84', '新增', '82', '0', 'admin/category/add', '1', '模块管理', '');
INSERT INTO `sys_menu` VALUES ('85', '编辑', '82', '0', 'admin/category/edit', '1', '模块管理', '');
INSERT INTO `sys_menu` VALUES ('86', '删除', '82', '0', 'admin/category/destroy', '1', '模块管理', '');
INSERT INTO `sys_menu` VALUES ('87', '更新', '82', '0', 'admin/category/update', '1', '模块管理', '');
INSERT INTO `sys_menu` VALUES ('88', '新增', '83', '0', 'admin/article/add', '1', '内容管理', '');
INSERT INTO `sys_menu` VALUES ('89', '编辑', '83', '0', 'admin/article/edit', '1', '内容管理', '');
INSERT INTO `sys_menu` VALUES ('90', '删除', '83', '0', 'admin/article/destroy', '1', '内容管理', '');
INSERT INTO `sys_menu` VALUES ('91', '更新', '83', '0', 'admin/article/update', '1', '内容管理', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名:手机号',
  `is_auth` tinyint(4) NOT NULL DEFAULT '0' COMMENT '手机号是否认证通过:1已认证，0未认证',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户类型:1普通2广告主',
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '联系人',
  `qq` varchar(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `weixin` varchar(150) NOT NULL DEFAULT '' COMMENT '微信',
  `freeze` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '冻结金额',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `custom_id` int(11) NOT NULL DEFAULT '0' COMMENT '客服ID',
  `custom_name` varchar(150) NOT NULL DEFAULT '' COMMENT '客服名称',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:-1删除、0锁定、1正常、2待审核',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '记住我',
  `reg_time` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `reg_ip` varchar(45) DEFAULT NULL COMMENT '注册IP',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(45) DEFAULT NULL COMMENT '最后登录IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COMMENT='用户基本信息';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('7', '15826021109', '0', '1', '唐吉思', '1342234899', 'tangjisi', '0.00', '0.00', '2', '永和', '1', 'tangjisi@sina.cn', '$2y$10$P38B8R1s.zKbzJYQpt/M/Oc2/H6H48DXE5wl8I6IGEH.fz6jAO4JG', null, '2016-10-14 15:07:20', '127.0.0.1', null, null);
INSERT INTO `user` VALUES ('10', '15826021108', '0', '2', '唐平', '', '', '0.00', '0.00', '3', '颖楓', '1', '', '$2y$10$y35S71eQ6u4xPnK59x8kcuJep/glGeBngNHQwd93nqj/vVV3g1CJa', null, '2016-10-15 12:30:34', '127.0.0.1', null, null);
INSERT INTO `user` VALUES ('11', '15826021189', '0', '2', '斯蒂芬', '56485254', 'huituo', '0.00', '0.00', '0', '', '1', '526498@qq.com', '$2y$10$aaIyKaV/IvBWnHl/8z8iguXR7.j7IqjkluN4dmgBMnmm66NWqnTbS', null, '2016-10-15 12:38:57', '127.0.0.1', null, null);
INSERT INTO `user` VALUES ('12', '13667635689', '0', '2', '单簧管', '2312312312', '', '0.00', '0.00', '3', '颖楓', '1', '', '$2y$10$NQeOkY7vxjxOpY8IvVlas.6zPwRSzjrj/Eh8r.LHjPl2heHg.XxdC', null, '2016-10-15 13:02:36', '127.0.0.1', null, null);
INSERT INTO `user` VALUES ('21', '13667635645', '1', '1', 'dsfas', '123213123', '', '0.00', '0.00', '2', '永和', '2', '', '$2y$10$3CDW1Tz/TCHMYEj44Fb5TeAECnrWtquiI1PacCouyAZ71D2k5bfdi', 'HClO3wFDtdUGHrSd7VI7jpW3VZoTGWTd9094g1tDtIiXng4bYTXb1NwynpAx', '2016-10-27 17:55:01', '127.0.0.1', '2016-11-02 13:49:59', '127.0.0.1');
INSERT INTO `user` VALUES ('22', '13667635622', '1', '1', '唐瓶d', '342234898', 'sadfsdafsdaf', '0.00', '0.00', '3', '颖楓', '1', 'afdsdaf@qq.com', '$2y$10$3MryRZyvggPydAAEfkfWd.4H//C44u8umvNP6lL.qra/N7CNoxipi', 'UOLqWywzRxNCpiLLiyrqqY2LuyEqawSpHJcb8BYAdANDYUuikyUtVifWCWm1', '2016-10-27 21:10:25', '127.0.0.1', '2016-10-29 12:57:28', '127.0.0.1');
INSERT INTO `user` VALUES ('23', '13667652103', '1', '2', '沙发党', '12312312313', 'afafdasdfasf', '0.00', '0.00', '2', '永和', '1', 'afsdaff.@q.com', '$2y$10$tWONBoJUfM.qEKeRo3I/ROxEADOdNnmlBriiqWMNqiZueuWq6K5QG', 'Uxt8XZdrn8GMHo03PQNVbhbTND8YrLPEVZIHbRsmpckmvrZbllApPhhRKBz4', '2016-10-29 09:35:13', '127.0.0.1', '2016-10-29 12:41:27', '127.0.0.1');

-- ----------------------------
-- Table structure for user_ads
-- ----------------------------
DROP TABLE IF EXISTS `user_ads`;
CREATE TABLE `user_ads` (
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `company` varchar(255) NOT NULL DEFAULT '' COMMENT '公司名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='广告主用户扩展信息';

-- ----------------------------
-- Records of user_ads
-- ----------------------------
INSERT INTO `user_ads` VALUES ('10', '');
INSERT INTO `user_ads` VALUES ('11', '重庆艾克公司');
INSERT INTO `user_ads` VALUES ('12', '重庆大兮控股');
INSERT INTO `user_ads` VALUES ('23', '重庆是枕骨');

-- ----------------------------
-- Table structure for user_personal
-- ----------------------------
DROP TABLE IF EXISTS `user_personal`;
CREATE TABLE `user_personal` (
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `medias` int(11) NOT NULL DEFAULT '0' COMMENT '媒体资源数量',
  `wait_account` decimal(10,2) DEFAULT '0.00' COMMENT '待结算金额',
  `finish_account` decimal(10,2) DEFAULT '0.00' COMMENT '已结算金额'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='普通用户扩展信息';

-- ----------------------------
-- Records of user_personal
-- ----------------------------
INSERT INTO `user_personal` VALUES ('6', '0', null, null);
INSERT INTO `user_personal` VALUES ('7', '0', null, null);
