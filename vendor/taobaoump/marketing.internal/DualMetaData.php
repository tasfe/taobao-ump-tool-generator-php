<?php
include_once '../../marketing.internal/CompositeMetaData.php';

/**
 * 封装了两个MetaData的元数据，主要针对 Operation = Condition + Action 的组装规则
 * @author taobao 2011-4-25 下午12:07:09
 */
class DualMetaData extends CompositeMetaData {
	
	protected $first;
	protected $second;
	
	public function DualMetaData($first, $second){
		if ( $first == null || $second == null ) {
			throw new Exception("需要两个元素才能完成组合");
		}
		$this->first = $first;
		$this->second = $second;
	}
	
	public function getElements(){
		return array($this->first, $this->second);
	}
	/**
	 * @return the $first
	 */
	public function getFirst(){
		return $this->first;
	}
	
	/**
	 * @return the $second
	 */
	public function getSecond(){
		return $this->second;
	}

}

?>