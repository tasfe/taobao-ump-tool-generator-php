<?php

/**
 * 参数值
 * @author taobao 2011-4-22 下午04:24:46
 */
class ParameterValue {
	
	/** 已定义参数值 */
	const KIND_DEFINED = 'DEFINED';
	/** 资源型元数据的参数值 */
	const KIND_RESOURCE = 'RESOURCE';
	/** 工具组装时未定义的参数值，在实例化时定义  */
	const KIND_UNDEFINE = 'UNDEFINE';
	
	private $id; //参数值在工具中的唯一 id
	private $parameterDef; //参数值所对应的参数定义
	private $metaDef; //参数所属的元数据定义
	private $kind; //参数值的来源类型
	private $value; //参数值
	

	/**
	 * @param string $id
	 * @param ParameterDef $parameterDef
	 * @param MetaDef $metaDef
	 * @param string $kind
	 * @param object $value
	 */
	public function ParameterValue($id, $parameterDef, $metaDef, $kind, $value){
		$this->id = $id;
		$this->parameterDef = $parameterDef;
		$this->metaDef = $metaDef;
		$this->kind = $kind;
		$this->value = $value;
	}
	
	/**
	 * @return the $id
	 */
	public function getId(){
		return $this->id;
	}
	
	/**
	 * @return the $value
	 */
	public function getValue(){
		return $this->value;
	}
	
	/**
	 * @return the $kind
	 */
	public function getKind(){
		return $this->kind;
	}
	
	/**
	 * @return the $metaDef
	 */
	public function getMetaDef(){
		return $this->metaDef;
	}
	
	/**
	 * @return ParameterDef
	 */
	public function getParameterDef(){
		return $this->parameterDef;
	}
	
	/**
	 * @param $id the $id to set
	 */
	public function setId($id){
		$this->id = $id;
	}
	
	/**
	 * @param $value the $value to set
	 */
	public function setValue($value){
		$this->value = $value;
	}
	
	/**
	 * @param $kind the $kind to set
	 */
	public function setKind($kind){
		$this->kind = $kind;
	}
	
	/**
	 * @param $metaDef the $metaDef to set
	 */
	public function setMetaDef($metaDef){
		$this->metaDef = $metaDef;
	}
	
	/**
	 * @param $parameterDef the $parameterDef to set
	 */
	public function setParameterDef($parameterDef){
		$this->parameterDef = $parameterDef;
	}

}

?>