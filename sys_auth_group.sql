/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : wanghong

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-10-28 16:00:05
*/

SET FOREIGN_KEY_CHECKS=0;

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
