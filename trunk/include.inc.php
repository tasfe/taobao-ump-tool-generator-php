<?php
error_reporting(E_ALL);//comment it if u want
//以下三个参数需要设定
defined('TAOBAO_APIKEY') or define('TAOBAO_APIKEY','yourkey');
defined('TAOBAO_APP_SECRET') or define('TAOBAO_APP_SECRET','your secret');
defined('TAOBAO_SANDBOX') or define('TAOBAO_SANDBOX',false);//正式环境

require __DIR__.'/common/SystemHelper.php';
$paths=array('/vendor/taobaoapi','/vendor/taobaoump/marketing',
		'/vendor/taobaoump/marketing.internal','/vendor/taobaoump/marketing.meta',
		'/vendor/taobaoump/marketing.service','/ump','/common');
$paths=array_map(function($s){return __DIR__.$s;}, $paths);
SystemHelper::addIncludePath($paths);
SystemHelper::registerAutoloader();
SystemHelper::chdir(__DIR__.'/vendor/taobaoump/marketing.test/test');

