<?php
include_once '../../marketing.meta/MetaDef.php';

/**
 * 资源型元数据定义。
 * 执行后将返回值存放在上下文的特定字段中
 * @author taobao 2011-4-22 下午07:09:51
 */
class ResourceDef extends MetaDef {
	
	private $resultDef;
	
	public function ResourceDef($id, $parameters = array(), $desc = null, $resultDef = null){
		$this->MetaDef($id, $parameters, $desc);
		$this->resultDef = $resultDef;
	}
	
	/**
	 * @return the $resultDef
	 */
	public function getResultDef(){
		return $this->resultDef;
	}
	
	/**
	 * @param $resultDef the $resultDef to set
	 */
	public function setResultDef($resultDef){
		$this->resultDef = $resultDef;
	}

}

?>