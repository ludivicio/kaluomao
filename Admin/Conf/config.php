<?php
return array(
	//'配置项'=>'配置值'

	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__ . '/Admin/Tpl/Public'
	),
	
	'LOAD_EXT_CONFIG' => 'menu,db',
	// 控制器不区分大小写
	'URL_CASE_INSENSITIVE' => true,
);
?>