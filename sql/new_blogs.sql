DROP TABLE IF EXISTS `bg_users`;
-- 1、用户表
CREATE TABLE `bg_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '电子邮件',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `login_ip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆ip',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户类型0:普通用户,1:管理员',
  `remarks` text COMMENT '备注',
  `login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `deleted_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_id` (`email`,`id`),
  KEY `blog_name_pass` (`username`,`password`),
  KEY `blog_email_pass` (`email`,`password`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

INSERT INTO `bg_users` VALUES ('1', 'admin', '臭不要脸的', '$2y$10$TKyqv10LedsMxbwVP2QFFOM0DA4xgibDRyUIlEHl6hL/6Imvwarc.', '18365295838@163.com', '18365295838', '2130706433', '1', '第一次登陆','2018-04-14 21:14:45', '2018-04-14 21:14:45', '2018-04-14 21:14:45', '0');

-- 2、统计用户访问信息
CREATE TABLE `bg_user_visits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '访问用户的uid',
  `visit_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '访问ip',
  `visit_num` int(11) NOT NULL DEFAULT '0' COMMENT '用户访问的次数',
  `visit_url` varchar(255) NOT NULL DEFAULT '' COMMENT '访问路径',
  `is_member` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是会员0-不是，1-是',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `visit_ip` (`visit_ip`),
  KEY `visit_url` (`visit_url`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='统计用户访问信息';

-- 3、用户-角色关系表
CREATE TABLE `bg_user_roles` (
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `role_id` varchar(100) NOT NULL DEFAULT '' COMMENT '角色ID',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户-角色关系表';

-- 4、系统统计表
CREATE TABLE `bg_system_counts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '累计会员数量(注册的人数)',
  `visit_num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '累计访问量',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `update_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='系统统计表';

-- 5、角色表
CREATE TABLE `bg_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名称',
  `remarks` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `sort` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序越小越靠前',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='角色表';

-- 6、角色-权限关系表
CREATE TABLE `bg_role_permissions` (
  `role_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `menu_id` varchar(255) NOT NULL DEFAULT '' COMMENT '权限ID',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色-权限关系表';

-- 7、目录表
CREATE TABLE `bg_menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '目录名称',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '目录路由',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示0: 隐藏 1:显示',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '图标',
  `depth` tinyint(1) NOT NULL DEFAULT '1' COMMENT '深度',
  `sort` tinyint(3) NOT NULL DEFAULT '1' COMMENT '排序越小越靠前',
  `remarks` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='目录表';

-- 8、图标表
CREATE TABLE `bg_icons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'ICON名',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='图标表';

-- 9、每日浏览统计
CREATE TABLE `bg_day_counts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `visit_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '访问ip',
  `visit_num` int(11) DEFAULT '0' COMMENT '用户访问的次数',
  `is_member` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是会员0-不是，1-是',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `visit_ip` (`visit_ip`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='每日浏览统计';

-- 10、个人日记表
CREATE TABLE `bg_dairies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建用户ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `contents` text COMMENT '日记内容',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` int(11) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='个人日记表';

-- 11、附件表
CREATE TABLE `bg_attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `original` varchar(255) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `size` varchar(10) NOT NULL DEFAULT '' COMMENT '文件大小',
  `ext` varchar(255) NOT NULL DEFAULT '' COMMENT '文件尾缀',
  `mime_type` varchar(255) NOT NULL DEFAULT '' COMMENT '文件类型',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='附件表';

-- 12、文章表
CREATE TABLE `bg_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建者id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '文章图片',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '关联文章的url',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '文章关键字',
  `like_num` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `read_num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '阅读数',
  `comment_num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文章分类ID',
  `type_id` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '文章标签 0:原创 1:转载 2:翻译',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `contents` text COMMENT '文章内容',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶 0:否 1:是',
  `is_comment` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否评论 0:否 1:是',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐 0:否 1:是',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `deleted_at` int(11) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `id_category_id` (`id`,`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='文章表';

-- 13、文章分类表
CREATE TABLE `bg_article_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类标题',
  `use_num` int(11) NOT NULL DEFAULT '0' COMMENT '该标签被存储的次数',
  `article_ids` varchar(255) NOT NULL DEFAULT '0' COMMENT '以json格式存放文章的ID',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `deleted_at` int(11) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='文章分类表';

-- 14、广告表
CREATE TABLE `bg_adverts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建用户ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '广告标题',
  `type_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '广告类型',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '相关跳转路由',
  `attachment_id` int(11) NOT NULL DEFAULT '0' COMMENT '附件ID',
  `remarks` varchar(500) NOT NULL DEFAULT '' COMMENT '广告备注',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `type_id` (`type_id`),
  KEY `attachment_id` (`attachment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='广告表';