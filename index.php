<?php

/**
主入口文件
*/

//定义项目名，对应配置在/config/appConfig
define('APP_NAME', 'main');

define('SITE_NAME', '项目文档');
define('SITE_NAME_EXP', ' - 文档管理系统');
define('LI', '&nbsp;&nbsp;├─');

//程序目录
define('APP_PATH', dirname(__FILE__) . '/');
require APP_PATH . 'sail.php';


