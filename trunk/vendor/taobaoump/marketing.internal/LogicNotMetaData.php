<?php
include_once '../../marketing.internal/CompositeMetaData.php';

/**
 * @author taobao 2011-4-22 下午02:48:56
 */
class LogicNotMetaData extends CompositeMetaData {
	protected $metaData;
	
	public function LogicNotMetaData($metaData){
		$this->metaData = $metaData;
	}
	
	public function logicNot(){
		return $this->metaData;
	}
	
	public function getElements(){
		return array($this->metaData);
	}

}

?>