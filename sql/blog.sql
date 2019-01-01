DROP TABLE IF EXISTS `bg_users`;
CREATE TABLE `bg_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '电子邮件',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `login_ip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆ip',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户类型0:普通用户,1:管理员',
  `remarks` text COMMENT '备注',
  `login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `deleted_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_id`(`email`,`id`),
  KEY `blog_name_pass` (`username`,`password`),
  KEY `blog_email_pass` (`email`,`password`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

-- alter table blog_users MODIFY  login_ip bigint(20) unsigned not null default '0' COMMENT '管理员登陆ip';
-- ----------------------------
-- Records of blog_admin
-- ----------------------------
INSERT INTO `bg_users` VALUES ('1', '臭不要脸的', 'admin', '$2y$10$TKyqv10LedsMxbwVP2QFFOM0DA4xgibDRyUIlEHl6hL/6Imvwarc.', '18365295838@163.com', '18365295838', '2130706433', '1', '第一次登陆','2018-04-14 21:14:45', '2018-04-14 21:14:45', '2018-04-14 21:14:45', '0');


-- 文章
CREATE TABLE `bg_articles`(
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建者id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '文章图片',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '关联文章的url',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '文章关键字',
  `like_num` int(10) not null DEFAULT '0' comment '点赞数',
  `read_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读数',
  `comment_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `category_id` INT(10) unsigned not NULL DEFAULT '0' comment '文章分类ID',
  `tag_id` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '文章标签 0:原创 1:转载 2:翻译',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `contents` text COMMENT '文章内容',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶 0:否 1:是',
  `is_comment` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否评论 0:否 1:是',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐 0:否 1:是',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `deleted_at` int(11) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `id_category_id` (`id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章表';

-- 文章分类
CREATE TABLE `bg_article_categories`(
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` VARCHAR(255) NOT NULL DEFAULT '' comment'分类标题',
  `use_num` int(11) NOT NULL default '0' comment '该标签被存储的次数',
  `article_ids` VARCHAR(255) NOT NULL DEFAULT '0' comment '以json格式存放文章的ID',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `deleted_at` int(11) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='文章分类表';

-- 个人日记
CREATE TABLE `bg_dairies`(
  `id` INT(10) unsigned NOT NULL auto_increment,
  `uid` INT(10) unsigned NOT NULL DEFAULT 0 comment '创建用户ID',
  `title` VARCHAR(255) NOT NULL DEFAULT '' comment '标题',
  `contents` text comment '日记内容',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
  `deleted_at` INT(0) NOT NULL DEFAULT '0' comment '删除时间',
  PRIMARY KEY `id`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT '个人日记表';

-- 广告管理
CREATE TABLE `bg_adverts`(
  `id` INT(10) unsigned NOT NULL auto_increment,
  `uid` INT(10) unsigned NOT NULL DEFAULT 0 comment '创建用户ID',
  `title` VARCHAR(255) NOT NULL DEFAULT '' comment '广告标题',
  `type_id` tinyint(3) unsigned not null DEFAULT '0' comment '广告类型',
  `attachment_id` INT(11) NOT NULL DEFAULT '0' comment '附件ID',
  `path` VARCHAR(255) NOT NULL DEFAULT '' comment '相关跳转路由',
  `remarks` VARCHAR(500) NOT NULL DEFAULT '' comment '广告备注',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
  `deleted_at` INT(11) unsigned NOT NULL DEFAULT '0' comment '删除时间',
  PRIMARY KEY `id`(`id`),
  KEY `uid`(`uid`),
  KEY `type_id`(`type_id`),
  KEY `attachment_id`(`attachment_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT '广告表';


-- 附件表
CREATE TABLE IF NOT EXISTS `bg_attachments`(
  `id` int(11) unsigned NOT NULL auto_increment,
  `original` VARCHAR(255) NOT NULL DEFAULT '' comment '原始文件名',
  `filename` VARCHAR(255) NOT NULL DEFAULT '' comment '文件名',
  `path` VARCHAR(255) NOT NULL DEFAULT '' comment '文件路径',
  `size`  varchar(10) NOT NULL DEFAULT '' COMMENT '文件大小',
  `ext` VARCHAR(255) NOT NULL DEFAULT '' comment '文件尾缀',
  `mime_type` VARCHAR(255) NOT NULL DEFAULT '' comment '文件类型',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
  `deleted_at` INT(11) unsigned NOT NULL DEFAULT '0' comment '删除时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='附件表';


-- 2、用户-角色 (users_roles)
DROP TABLE IF EXISTS `bg_user_roles`;
CREATE TABLE `bg_user_roles` (
  `id` int unsigned not null auto_increment,
  `uid` int unsigned not null default '0' comment '用户ID',
  `role_id` VARCHAR(100) not null default '' comment '角色ID',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
  primary key(`id`),
  UNIQUE KEY `user_id` (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COMMENT='用户-角色关系表';


-- 3、角色表 (role)
DROP TABLE IF EXISTS `bg_roles`;
CREATE TABLE `bg_roles` (
  `id` int unsigned not null auto_increment,
  `name` varchar(32) not null default '' comment '角色名称',
  `remarks` varchar(100) not null default '' comment '备注',
  `sort` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序越小越靠前',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP comment '更新时间',
  `deleted_at` INT(11) unsigned NOT NULL DEFAULT '0' comment '删除时间',
  primary key(`id`),
  KEY `sort`(`sort`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COMMENT='角色表';


-- 4、角色-权限表 (role_permissions) role_id permission_id
DROP TABLE IF EXISTS `bg_role_permissions`;
CREATE TABLE `bg_role_authority` (
  `id` int unsigned not null auto_increment,
  `role_id` int unsigned not null default '0' comment '角色ID',
  `permission_id` VARCHAR(255) not null default '' comment '权限ID',
  `created_at` TIMESTAMP NOT NULL DEFAULT '0' comment '添加时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  primary key(`id`),
  key `permission_id` (`permission_id`),
  key `role_id` (`role_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='角色-权限关系表';


-- 5、权限表 (permission)
DROP TABLE IF EXISTS `bg_permissions`;
CREATE TABLE `bg_permissions` (
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
  `deleted_at` INT(11) unsigned NOT NULL DEFAULT '0' comment '删除时间',
  primary key(`id`),
  KEY `level`(`auth_level`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COMMENT='权限表[目录表]';

-- 系统统计表
DROP TABLE IF EXISTS `bg_system_counts`;
CREATE TABLE `bg_system_counts`(
  `id` int unsigned not null auto_increment,
  `member_num` int unsigned not null default '0' comment'累计会员数量(注册的人数)',
  `visit_num` int unsigned not null default '0' comment '累计访问量',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  PRIMARY KEY (`id`)
)ENGINE=Innodb DEFAULT CHARSET=utf8 auto_increment=1 comment='系统统计表';

-- 每日浏览统计
DROP TABLE IF EXISTS `bg_day_counts`;
CREATE TABLE `bg_day_counts`(
  `id` int unsigned not null auto_increment,
  `visit_ip` VARCHAR(20) not null default '' comment '访问ip',
  `is_member` tinyint(1) not null default '0' comment '是否是会员0-不是，1-是',
  `created_at` int unsigned not null DEFAULT '0' comment '添加时间',
  PRIMARY KEY (`id`)
)ENGINE=Innodb DEFAULT CHARSET=utf8 auto_increment=1 comment='每日浏览统计';

-- 6、权限-功能操作表 (permission_operate)
DROP TABLE IF EXISTS `bg_permission_operate`;
CREATE TABLE `bg_permission_operate` (
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



-- 文章评论表
CREATE TABLE IF NOT EXISTS `bg_comments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `from_uid` int(10) NOT NULL DEFAULT '0' comment '评论人ID',
  `type` tinyint(1) unsigened not null default '0' comment '类型,0:文章 1:评论',
  `comtents` text NOT NULL default '' comment '评论内容',
PRIMARY KEY  (`id`),
KEY `use_num` (`use_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='文章评论表';


-- 文章评论回复表
CREATE TABLE IF NOT EXISTS `bg_comment_replaies` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `comment_id` int(10) NOT NULL DEFAULT '0' comment '文章ID',
  `reply_id` int(10) NOT NULL DEFAULT '0' comment '回复目标ID',
  `from_uid` int(10) NOT NULL DEFAULT '0' comment '评论人ID',
  `to_uid` int(10) NOT NULL DEFAULT '0' comment '目标用户ID',
  `type` tinyint(1) unsigened not null default '0' comment '类型,0:文章 1:评论',
  `content` text NOT NULL default '' comment '评论内容',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP comment '创建时间',
PRIMARY KEY  (`id`),
KEY `use_num` (`use_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;