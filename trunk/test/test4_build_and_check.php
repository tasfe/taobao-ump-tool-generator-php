<?php
require_once __DIR__.'/../include.inc.php';
require __DIR__.'/UmpSimpleToolDefined.php';


$actions=UmpSimpleToolDefined::getTestToolActions2();
$toolBuilder=new  Ump2ToolBuilder('ORDER', $actions);
$json=$toolBuilder->buildJson();
//echo $json."\n";
$toolId=Ump2ToolUtil::addTool($json);
echo $toolId."\n";
$r=Ump2ToolUtil::checkTool($toolId);
print_r($r);
