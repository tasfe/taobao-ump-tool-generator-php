<?php
require_once __DIR__.'/../include.inc.php';
require __DIR__.'/UmpSimpleToolDefined.php';
$actions=UmpSimpleToolDefined::getTestToolActions0();
$toolBuilder=new  Ump2ToolBuilder('ORDER', $actions);
$json=$toolBuilder->buildJson();
echo $json."\n";

$actions=UmpSimpleToolDefined::getTestToolActions2();
$toolBuilder=new  Ump2ToolBuilder('ORDER', $actions);
$json=$toolBuilder->buildJson();
echo $json."\n";