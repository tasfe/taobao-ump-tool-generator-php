<?php

/**
 * 元数据
 * 元数据是由MetaDef和ParameterValue[]组装成的对象，是营销工具的基本构成元素
 * @author taobao 2011-4-22 下午04:22:02
 */
class MetaData {
	
	private $metaDef;
	private $parameterValues;
	private $tradeStatus;
	
	/**
	 * 将一个元数据定义和多个元数据参数值组装为一个元数据
	 * 元数据参数值可为零个或任意多个
	 * @param MetaDef $metaDef 元数据定义
	 * @param ParameterValue[] $parameterValues 参数值
	 * @param $tradeStatus
	 */
	public function MetaData($metaDef, $parameterValues, $tradeStatus){
		$this->metaDef = $metaDef;
		$this->parameterValues = $parameterValues;
		$this->tradeStatus = $tradeStatus;
	}
	
	/**
	 * 组装为逻辑与的关系
	 * @param $other
	 * @return LogicAndMetaData
	 */
	public function logicAnd(MetaData $other){
		return new LogicAndMetaData(array($this, $other));
	}
	
	/**
	 * 组装为逻辑或的关系
	 * 仅对Term、Condition类型的元数据有效
	 * @param $other
	 * @return LogicOrMetaData
	 */
	public function logicOr(MetaData $other){
		return new LogicOrMetaData(array($this, $other));
	}
	/**
	 * 组装为逻辑非的关系
	 * 仅对Term、Condition类型的元数据有效
	 * @return LogicNotMetaData
	 */
	public function logicNot(){
		return new LogicNotMetaData($this);
	}
	
	/**
	 * @return the $metaDef
	 */
	public function getMetaDef(){
		return $this->metaDef;
	}
	
	/**
	 * @return the $parameterValues
	 */
	public function getParameterValues(){
		return $this->parameterValues;
	}
	
	/**
	 * @param $metaDef the $metaDef to set
	 */
	public function setMetaDef($metaDef){
		$this->metaDef = $metaDef;
	}
	
	/**
	 * @param $parameterValues the $parameterValues to set
	 */
	public function setParameterValues($parameterValues){
		$this->parameterValues = $parameterValues;
	}
	/**
	 * @return the $tradeStatus
	 */
	public function getTradeStatus(){
		return $this->tradeStatus;
	}

	/**
	 * @param $tradeStatus the $tradeStatus to set
	 */
	public function setTradeStatus($tradeStatus){
		$this->tradeStatus = $tradeStatus;
	}


}
?>