create table `documents` (
    `id` int(11) not null auto_increment,
    `title` char(30) not null default '' comment '标题',
    `url` varchar(100) not null default '' comment '接口url',
    `type` char(10) not null default 'get' comment '请求方式get/post',
    `is_login` tinyint(1) not null default '0' comment '是否需要登录',
    `params` text not null comment '参数，json',
    `return` text not null comment '返回，json',
    `return_demo` text not null comment '返回数据demo',
    primary key(`id`)
) Engine=Innodb default charset=utf8 comment '文档主表';

