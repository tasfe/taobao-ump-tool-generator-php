<?php

/**
 * 参数定义
 * 用于描述元数据执行时的入参
 * @author taobao 2011-4-22 下午03:16:03
 */
class ParameterDef {
	
	/** 参数可接受的业务类型，全部可接受 */
	CONST LOGIC_TYPE_ALL = 0;
	/** 参数可接受的业务类型 1: 商品id */
	CONST LOGIC_TYPE_ITEMID = 1;
	/** 参数可接受的业务类型 2: 店铺id */
	CONST LOGIC_TYPE_SHOPID = 2;
	/** 参数可接受的业务类型 3: sellerId */
	CONST LOGIC_TYPE_SELLERID = 3;
	/** 参数可接受的业务类型 4: skuId */
	CONST LOGIC_TYPE_SKUID = 4;
	/** 参数可接受的业务类型 5: categoryId */
	CONST LOGIC_TYPE_CATEGORYID = 5;
	/** 参数可接受的业务类型 6: shopCategoryId */
	CONST LOGIC_TYPE_SHOPCATEGORYID = 6;
	
	/** 值类型 */
	CONST VALUE_TYPE_STRING = 'String';
	CONST VALUE_TYPE_DATE = 'Date';
	CONST VALUE_TYPE_BOOLEAN = 'Boolean';
	CONST VALUE_TYPE_DOUBLE = 'Double';
	CONST VALUE_TYPE_LONG = 'Long';
	CONST VALUE_TYPE_RESOURCE = 'Resource';
	
	private $name;
	private $desc;
	private $feature;
	private $array;
	private $valueType;
	private $logicType = ParameterDef::LOGIC_TYPE_ALL;
	
	/**
	 * @param string $name
	 * @param int $valueType
	 * @param string $desc
	 * @param boolean $isArray
	 */
	public function ParameterDef($name = null, $valueType = null, $desc = null, $isArray = false){
		$this->name = $name;
		$this->valueType = $valueType;
		$this->desc = $desc;
		$this->array = $isArray;
	}
	
	/**
	 * @return the $name
	 */
	public function getName(){
		return $this->name;
	}
	
	/**
	 * @return the $desc
	 */
	public function getDesc(){
		return $this->desc;
	}
	
	/**
	 * @return the $feature
	 */
	public function getFeature(){
		return $this->feature;
	}
	
	/**
	 * @return the $logicType
	 */
	public function getLogicType(){
		return $this->logicType;
	}
	
	/**
	 * @return the $valueType
	 */
	public function getValueType(){
		return $this->valueType;
	}
	
	/**
	 * @return the $array
	 */
	public function isArray(){
		return $this->array;
	}
	
	/**
	 * @param $name the $name to set
	 */
	public function setName($name){
		$this->name = $name;
	}
	
	/**
	 * @param $desc the $desc to set
	 */
	public function setDesc($desc){
		$this->desc = $desc;
	}
	
	/**
	 * @param $feature the $feature to set
	 */
	public function setFeature($feature){
		$this->feature = $feature;
	}
	
	/**
	 * @param $logicType the $logicType to set
	 */
	public function setLogicType($logicType){
		$this->logicType = $logicType;
	}
	
	/**
	 * @param $valueType the $valueType to set
	 */
	public function setValueType($valueType){
		$this->valueType = $valueType;
	}
	
	/**
	 * @param $array the $array to set
	 */
	public function setArray($array){
		$this->array = $array;
	}

}

?>