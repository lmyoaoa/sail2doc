create table `documents` (
    `id` int(11) not null auto_increment,
    `title` char(30) not null default '' comment '标题',
    `url` varchar(100) not null default '' comment '接口url',
    `type` char(10) not null default 'get' comment '请求方式get/post',
    `is_login` tinyint(1) not null default '0' comment '是否需要登录',
    `params` text not null comment '参数，json',
    `ret` text not null comment '返回，json',
    `ret_demo` text not null comment '返回数据demo',
    `tables` text not null comment '对应数据表',
    `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
    `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
    primary key(`id`)
) Engine=Innodb default charset=utf8 comment '文档主表';
ALTER TABLE `documents` ADD `cat_id` INT(11)  NOT NULL  DEFAULT '0'  COMMENT '所属分类id'  AFTER `title`;
ALTER TABLE `documents` ADD `read_type` CHAR(15)  NOT NULL  DEFAULT '读取'  COMMENT '读取接口/写入接口'  AFTER `cat_id`;



create table `dbs` (
    `id` int(11) not null auto_increment,
    `ip` char(15) not null default '' comment '远程数据库ip',
    `dbuser` varchar(50) not null default '' comment '远程数据库用户名',
    `dbpwd` varchar(100) not null default '' comment '密码',
    `port` char(15) not null default '' comment '端口',
    `dbname` char(20) not null default '' comment '库名',
    primary key(`id`)
) Engine=Innodb default charset=utf8 comment '数据库配置';

--分类表，以 项目-模块 来继承
create table `category` (
    `id` int(11) not null auto_increment,
    `title` varchar(50) not null default '' comment '分类名',
    `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父分类id',
    `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
    `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
    `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
    primary key(`id`)
) ENGINE=Innodb default charset=utf8 comment '分类表';

--用户表
create table `users` (
    `id` int(11) not null auto_increment,
    `username` varchar(30) not null default '' comment '用户名',
    `password` varchar(64) not null default '' comment '密码',
    `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
    `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
    primary key(`id`)
) ENGINE=Innodb default charset=utf8 comment '用户表';

