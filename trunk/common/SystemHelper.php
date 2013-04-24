<?php
class SystemHelper{
	
	public static function addIncludePath($paths){
		$includePaths=explode(PATH_SEPARATOR,get_include_path());
		$includePaths=array_merge(array('.'),(array)$paths,$includePaths);
		$pathStr=implode(PATH_SEPARATOR,array_unique($includePaths));
		set_include_path($pathStr);
	}
	
	public static function autoload($name){
		return require ($name.'.php');
	}
	
	public static function registerAutoloader($callback=null){
		if ($callback!==null){
			spl_autoload_unregister('SystemHelper::autoload');
			spl_autoload_register($callback);
		}
		spl_autoload_register('SystemHelper::autoload');
	}
	
	private static $oldDir;
	public static function chdir($dir){
		self::$oldDir=getcwd();
		chdir($dir);
	}
	
	public static function restoreChDir(){
		chdir(self::$oldDir);
	}
}
?>