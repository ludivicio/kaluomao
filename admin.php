<?php
	// 应用名称
	define('APP_NAME', 'Admin');
	// 应用路径
	define('APP_PATH', './Admin/');
	
	// 网站的路径
	define('WEB_ROOT', dirname(__FILE__) . '/');
	// 网站缓存路径
	define('WEB_CACHE_PATH', WEB_ROOT . 'Cache/');
	// 网站后台编译文件路径
	define('RUNTIME_PATH', WEB_ROOT . 'Runtime/Admin/');
	// 数据库备份路径
	define('DB_BACKUP_PATH', WEB_ROOT . 'Backup/Dbs/');

	// 开启调试模式
	define('APP_DEBUG', true);
	// 引入ThinkPHP核心库
	require './ThinkPHP/ThinkPHP.php';

?>
