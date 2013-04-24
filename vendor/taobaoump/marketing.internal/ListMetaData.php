<?php
include_once '../../marketing.internal/CompositeMetaData.php';

/**
 * @author taobao 2011-4-22 下午02:48:56
 */
class ListMetaData extends CompositeMetaData {
	
	protected $elements;
	
	public function ListMetaData($elements){
		if ( $elements == null || count($elements) <= 0 ) {
			throw new Exception("至少需要一个元素才能完成组合");
		}
		$this->elements = $elements;
	}
	
	public function getElements(){
		return $this->elements;
	}
	
	public function addElement($metaData){
		$this->elements[] = $metaData;
	}

}

?>