<?php
    @header("Content-type:text/html;charset=utf-8");
    define('DEBUG' , true);
//*
	define('DOCUMENT_ROOT','/Users/koudejian/www/startcraft/admin');    //网站根目录（最后不加/）
	define('WEBSITE_URL','http://localhost/startcraft/admin/');     //站点域名（最后加/）
	//分页参数
	define('PAGE_WEB_LIST',12);                //分页－WEB前端每页显示行数
    //
    define('TITLE', '星际争霸管理后台');
//*/
    
/*
	define('DOCUMENT_ROOT','/usr/share/nginx/www/startcraft/admin');    //网站根目录（最后不加/）
	define('WEBSITE_URL','http://218.244.156.133/startcraft/admin/');     //站点域名（最后加/）
	//分页参数
	define('PAGE_WEB_LIST',12);                //分页－WEB前端每页显示行数
    //
    define('TITLE', '星际争霸管理后台');
//*/
    
    if(DEBUG){
        error_reporting(E_ALL);
    }
?>
