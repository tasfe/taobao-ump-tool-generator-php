<?php
include_once '../../marketing.internal/ListMetaData.php';

/**
 * @author taobao 2011-4-22 下午02:48:56
 */
class LogicAndMetaData extends ListMetaData {
	
	public function LogicAndMetaData($metaData){
		$this->ListMetaData($metaData);
	}
	
	public function logicAnd($metaData){
		$this->addElement($metaData);
		return $this;
	}
}

?>