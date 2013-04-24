<?php
include_once '../../marketing.internal/CompositeMetaData.php';
include_once '../../marketing.meta/ParameterDef.php';
/**
 * 
 * @author taobao 2011-4-25 下午12:13:11
 */
class ConditionalMetaData extends CompositeMetaData {
	
	protected $metaData;
	
	public function ConditionalMetaData(MetaData $metaData, $paramId){
		$this->metaData = $metaData;
		$param = new ParameterValue($paramId, $this->getParameterDef(), null, ParameterValue::KIND_UNDEFINE, null);
		$this->setParameterValues(array($param));
	}
	
	public function getElement(){
		return $this->metaData;
	}
	
	public function getElements(){
		return array($this->metaData);
	}
	
	public function getParameterDef(){
		return new ParameterDef("ConditionalMetaData_ParameterDef", ParameterDef::VALUE_TYPE_BOOLEAN, "填入 boolean 值以确定包含的元数据是否需要执行");
	}
}

?>