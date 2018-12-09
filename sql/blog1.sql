/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : yii_blog

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-04-14 20:50:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_abouts
-- ----------------------------
DROP TABLE IF EXISTS `blog_abouts`;
CREATE TABLE `blog_abouts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' comment '用户id',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '标题',
  `contents` text COMMENT '内容',
  `is_comment` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许评论;1-允许 0-不允许',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否删除;1-正常 0-删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='与我有关表';

-- ----------------------------
-- Records of blog_abouts
-- ----------------------------

-- ----------------------------
-- Table structure for blog_article
-- ----------------------------
DROP TABLE IF EXISTS `blog_articles`;
CREATE TABLE `blog_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建者id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '文章图片',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '关联文章的url',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '文章关键字',
  `read_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读数',
  `comment_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '文章类型0-原创1-转载2-翻译',
  `utype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户类型0-管理员1-用户',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `assort_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文章分类id',
  `contents` text COMMENT '文章内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-正常 1-删除',
  `is_comment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否评论 0-允许 1-禁止',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐 0-不推荐 1-推荐',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `uid_utype` (`uid`,`utype`),
  KEY `id_assort_id` (`id`,`assort_id`),
  KEY `id_status` (`id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章表';

-- ----------------------------
-- Records of blog_article
-- ----------------------------

-- ----------------------------
-- Table structure for blog_types
-- ----------------------------
DROP TABLE IF EXISTS `blog_article_assorts`;
CREATE TABLE `blog_article_assorts` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '文章分类名称',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序,数值越小越靠前',
  `status`  tinyint(1) NOT NULL  DEFAULT '0' COMMENT '是否显示 0-正常 1-删除',
  `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of blog_types
-- ----------------------------


-- ----------------------------
-- Table structure for blog_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `actid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文章的id',
  `uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '评论人id',
  `content` varchar(500) NOT NULL DEFAULT '' COMMENT '评论内容',
  `comment_name` varchar(255) NOT NULL DEFAULT '' COMMENT '评论人id',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1-正常 0-删除',
  PRIMARY KEY (`id`),
  KEY `actid_uid` (`actid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Records of blog_comment
-- ----------------------------

-- ----------------------------
-- Table structure for blog_slide
-- ----------------------------
DROP TABLE IF EXISTS `blog_slide`;
CREATE TABLE `blog_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '图片路径',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '相关链接地址',
  `remarks` varchar(500) NOT NULL DEFAULT '' COMMENT '图片配文',
  `is_show`  tinyint(1) NOT NULL  DEFAULT '0' COMMENT '是否显示 0-不显示 1-显示',
  `status`  tinyint(1) NOT NULL  DEFAULT '1' COMMENT '是否显示 1-正常 0-删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='幻灯片表';

-- ----------------------------
-- Records of blog_slide
-- ----------------------------

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_users`;
CREATE TABLE `blog_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '电子邮件',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `login_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员登陆ip',
  `utype` tinyint unsigned NOT NULL DEFAULT '100' COMMENT '用户类型100-普通用户,200-管理员',
  `login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否删除;1-正常 0-删除',
  `remarks` text COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_id`(`email`,`id`),
  KEY `blog_name_pass` (`username`,`password`),
  KEY `blog_email_pass` (`email`,`password`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员表';

ALTER TABLE `blog_users` ADD `utype` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '用户类型100-普通用户,200-管理员'  AFTER `login_ip`;
alter table blog_users MODIFY  login_ip bigint(20) unsigned not null default '0' COMMENT '管理员登陆ip';
-- ----------------------------
-- Records of blog_admin
-- ----------------------------
INSERT INTO `blog_users` VALUES ('1', 'admin', '$2y$10$TKyqv10LedsMxbwVP2QFFOM0DA4xgibDRyUIlEHl6hL/6Imvwarc.', '', '', '2130706433', '200','0', '0', '2018-04-14 21:14:45', '1', '');


-- 2、用户-角色 (users_roles)
DROP TABLE IF EXISTS `blog_user_role`;
CREATE TABLE `blog_user_role` (
  `id` int unsigned not null auto_increment,
  `user_id` int unsigned not null default '0' comment '用户ID',
  `role_id` VARCHAR(100) not null default '' comment '角色ID',
  `status`  tinyint(1) not null default '1' comment '状态 1-正常;0-删除',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  primary key(`id`),
  UNIQUE KEY `user_id` (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='用户-角色关系表';



-- 3、角色表 (role)
DROP TABLE IF EXISTS `blog_roles`;
CREATE TABLE `blog_roles` (
  `id` int unsigned not null auto_increment,
  `name` varchar(32) not null default '' comment '角色名称',
  `message` varchar(100) not null default '' comment '备注',
  `sort` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序越小越靠前',
  `status`  tinyint(1) not null default '1' comment '状态 1-正常;0-删除',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  `updated_at` int unsigned not null DEFAULT '0' comment '修改时间',
  primary key(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='角色表';




-- 4、角色-权限表 (role_auth) role_id auth_id
DROP TABLE IF EXISTS `blog_role_authority`;
CREATE TABLE `blog_role_authority` (
  `id` int unsigned not null auto_increment,
  `role_id` int unsigned not null default '0' comment '角色ID',
--   `auth_id` int unsigned not null default '0' comment '权限ID',
  `auth_id` VARCHAR(500) not null default '' comment '权限ID',
  `status`  tinyint(1) not null default '1' comment '状态 1-正常;0-删除',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  `updated_at` int unsigned not null DEFAULT '0' comment '修改时间',
  primary key(`id`),
  key `auth_id` (`auth_id`),
  key `role_id` (`role_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='角色-权限关系表';

ALTER TABLE `blog_role_authority` CHANGE `auth_id` `auth_id` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限ID';

-- 5、权限表 (permission)
DROP TABLE IF EXISTS `blog_authority`;
CREATE TABLE `blog_authority` (
  `id` int unsigned not null auto_increment,
  `title` varchar(100)  not null default '' comment '权限名称',
  `controller_name` varchar(100) not null default '' comment '控制器名',
  `method_name` varchar(100) not null default '' comment '方法名',
  `access_path` varchar(500) NOT NULL DEFAULT '' COMMENT 'json格式访问的全路径',
  `parent_id`  tinyint(3) unsigned not null default '0' comment '父级id',
  `auth_level`  tinyint(1) not null default '0' comment '级别,基本:0, 顶级:1-项目名, 次顶级:2-控制器名, 次次顶级:3-方法名',
  `status`  tinyint(1) not null default '1' comment '状态 1-正常;0-删除',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  `updated_at` int unsigned not null DEFAULT '0' comment '修改时间',
  primary key(`id`),
  KEY `level`(`auth_level`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='权限表[目录表]';

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL auto_increment,
  `title` varchar(255)  NOT NULL DEFAULT '' comment '权限名称',
  `controller_name` varchar(255) NOT NULL DEFAULT '' comment '控制器名',
  `method_name` varchar(255) NOT NULL DEFAULT '' comment '方法名',
  `access_path` varchar(255) NOT NULL DEFAULT '' COMMENT 'json格式访问的全路径',
  `parent_id`  tinyint(3) unsigned NOT NULL DEFAULT '0' comment '父级id',
  `auth_level`  tinyint(1) NOT NULL DEFAULT '0' comment '级别,基本:0, 顶级:1-项目名, 次顶级:2-控制器名, 次次顶级:3-方法名',
  `status`  tinyint(1) NOT NULL DEFAULT '1' comment '状态 1-正常;0-删除',
  `created_at` TIMESTAMP NOT NULL DEFAULT '0' comment '添加时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  primary key(`id`),
  KEY `level`(`auth_level`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COMMENT='权限表[目录表]';

-- 系统统计表
DROP TABLE IF EXISTS `blog_system_counts`;
CREATE TABLE `blog_system_counts`(
  `id` int unsigned not null auto_increment,
  `member_num` int unsigned not null default '0' comment'累计会员数量(注册的人数)',
  `visit_num` int unsigned not null default '0' comment '累计访问量',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  PRIMARY KEY (`id`)
)ENGINE=Innodb DEFAULT CHARSET=utf8 auto_increment=1 comment='系统统计表';

-- 每日浏览统计
DROP TABLE IF EXISTS `blog_day_counts`;
CREATE TABLE `blog_day_counts`(
  `id` int unsigned not null auto_increment,
  `visit_ip` VARCHAR(20) not null default '' comment '访问ip',
  `is_member` tinyint(1) not null default '0' comment '是否是会员0-不是，1-是',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  PRIMARY KEY (`id`)
)ENGINE=Innodb DEFAULT CHARSET=utf8 auto_increment=1 comment='每日浏览统计';



/*后面的不需要*/

-- 6、权限-功能操作表 (permission_operate)
DROP TABLE IF EXISTS `blog_permission_operate`;
CREATE TABLE `blog_permission_operate` (
  `id` int unsigned not null auto_increment,
  `ope_id` int unsigned not null default '0' comment '操作ID',
  `per_id` int unsigned not null default '0' comment '权限ID',
  `status`  tinyint(1) not null default '1' comment '状态 1-正常;0-删除',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  `updated_at` int unsigned not null DEFAULT '0' comment '修改时间',
  primary key(`id`),
  key per_id (`per_id`),
  key ope_id (`ope_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='权限-功能操作关系表';


-- 7、功能操作表 (operate)
DROP TABLE IF EXISTS `blog_operate`;
CREATE TABLE `blog_operate` (
  `id` int unsigned not null auto_increment,
  `controller_name` varchar(32) not null default '' comment '控制器名',
  `method_name` varchar(32) not null default '' comment '方法名',
  `access_path` varchar(255) not null default '' comment '权限路径',
  `message` varchar(100) not null default '' comment '备注',
  `status`  tinyint(1) not null default '1' comment '状态 1-正常;0-删除',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  `updated_at` int unsigned not null DEFAULT '0' comment '修改时间',
  primary key(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='功能操作表';
