<?php
include_once '../../marketing.internal/ListMetaData.php';

/**
 * @author taobao 2011-4-22 下午02:48:56
 */
class LogicOrMetaData extends ListMetaData {
	
	public function LogicOrMetaData($elements){
		$this->ListMetaData($elements);
	}
	
	public function logicOr(MetaData $metaData){
		$this->addElement($metaData);
		return $this;
	}
}

?>