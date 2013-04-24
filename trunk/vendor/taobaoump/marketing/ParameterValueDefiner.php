<?php
include_once '../../marketing/MarketingException.php';
/**
 * 参数值定义
 * @author taobao 2011-4-25 下午02:58:56
 */
class ParameterValueDefiner {
	
	private $defined; //已配置的参数值
	private $definable; //可配置的参数值
	

	/**
	 * @param $defined
	 * @param $definable
	 */
	public function ParameterValueDefiner($defined = array(), $definable = array()){
		$this->initParams($defined, $definable);
	}
	
	/**
	 * @param $defined
	 * @param $definable
	 */
	public function initParams($defined = array(), $definable = array()){
		$this->defined = $defined;
		$this->definable = $definable;
	}
	
	/**
	 * 为指定参数配置值。只能对#getDefinableParameters()指定的那些参数进行配置
	 * @param $paramId 目标参数的id
	 * @param $value 要配置的值
	 * @param $valueType
	 * @param $isArray
	 * @return boolean
	 * @see #getDefinableParameters() 取得可配置的参数列表
	 * @see #getUndefineParameters() 取得未配置的参数列表
	 */
	function define($paramId, $value, $valueType = ParameterValue::VALUE_TYPE_STRING, $isArray = false){
		$param = $this->definable[$paramId];
		if ( $param == null ) {
			throw new MarketingException("参数不存在或不可被配置，paramId=" . $paramId);
		}
		$paramDef = new ParameterDef(null, $valueType, null, $isArray);
		$this->defined[$paramId] = new ParameterValue($paramId, $paramDef, $param->getMetaDef(), ParameterValue::KIND_DEFINED, $value);
	}
	
	/**
	 * 取消对指定参数配置的值。只能对方法 #getDefinedParameters()指定的那些参数取消配置
	 * @param paramId 目标参数的id
	 * @return boolean
	 * @see #getDefinedParameters() 取得已配置的参数列表
	 */
	function undefine($paramId){
		unset($this->defined[$paramId]);
	}
	
	/**
	 * 取得需要配置的参数列表
	 * @return array
	 */
	function getMustDefineParameters(){
		//TODO 未实现
	}
	
	/**
	 * 取得已配置的参数列表
	 * @return array
	 */
	function getDefinedParameters(){
		return $this->defined;
	}
	
	/**
	 * 取得可配置的参数列表
	 * @return array
	 */
	function getDefinableParameters(){
		return $this->definable;
	}
	
	/**
	 * 验证是否全部需要定义的参数都已经被定义
	 * @return array
	 */
	function isAllDefined(){
		//TODO 未实现
	}
}

?>