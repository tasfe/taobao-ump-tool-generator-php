<?php

/**
 * 优惠范围元数据定义。
 * @author keyboard 2011-4-29 下午03:40:29
 */
class RangeDef {
	
	private $rangeType;
	
	public function RangeDef($id, $parameters = array(), $desc = null, $rangeType = null){
		$this->MetaDef($id, $parameters, $desc);
		$this->rangeType = $rangeType;
	}
	
	/**
	 * @return the $rangeType
	 */
	public function getRangeType(){
		return $this->rangeType;
	}

	/**
	 * @param $rangeType the $rangeType to set
	 */
	public function setRangeType($rangeType){
		$this->rangeType = $rangeType;
	}

	
	
}

?>