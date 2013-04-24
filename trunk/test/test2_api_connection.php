<?php
require_once __DIR__.'/../include.inc.php';
$code='com.taobao.ump.meta.action.decreaseMoney';
$arr=Ump2ToolUtil::findMbbByCode($code);
print_r($arr);