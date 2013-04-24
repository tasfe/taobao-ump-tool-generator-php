<?php
class CommonHelper{
	public static function sureDefined($arr,$defaultArr){
		$res=array_merge($defaultArr,$arr);
		return $res;
	}
}

?>