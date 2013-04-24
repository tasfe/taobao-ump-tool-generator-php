<?php

/**
 * 元数据定义
 * 包括元数据本身的描述信息和元数据参数的描述信息
 * @see ParameterDef
 * @see MetaConstants
 * @author taobao 2011-4-22 下午03:16:03
 */
class MetaDef {
	
	/**
	 * 交易前
	 */
	const TRADE_STATUS_BEFORE_CREATE_ORDER = 1;
	/**
	 * 创建订单后
	 */
	const TRADE_STATUS_AFTER_CREATE_ORDER = 3;
	
	/**
	 * 交易关闭
	 */
	const TRADE_STATUS_TRADE_CLOSE = 5;
	
	/**
	 * 交易成功
	 */
	const TRADE_STATUS_TRADE_FINISH = 6;
	
	/**
	 * 参数正常状态
	 */
	const STATUS_NORMAL = 1;
	
	/**
	 * 参数删除状态
	 */
	const STATUS_DELETE = - 1;
	
	private $id;
	private $name;
	private $desc;
	private $metaId;
	private $factoryId;
	private $parameters; //元数据入参
	private $startTime; //元数据生效开始时间
	private $endTime; //元数据生效结束时间	
	private $privilege; //访问权限，用于控制该元数据的公开性
	private $providerType; //提供者类型
	private $securityLevel; //安全级别，用于控制元数据的使用和访问
	private $providerKey;

	/**
	 * @param $id
	 * @param $parameters
	 * @param $desc
	 */
	public function MetaDef($id, $parameters = null, $desc = null){
		$this->id = $id;
		$this->parameters = $parameters;
		$this->desc = $desc;
	}
	
	/**
	 * @return the $id
	 */
	public function getId(){
		return $this->id;
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
	 * @return the $metaId
	 */
	public function getMetaId(){
		return $this->metaId;
	}
	
	/**
	 * @return the $factoryId
	 */
	public function getFactoryId(){
		return $this->factoryId;
	}
	
	/**
	 * @return the $parameters
	 */
	public function getParameters(){
		return $this->parameters;
	}
	
	/**
	 * @return the $startTime
	 */
	public function getStartTime(){
		return $this->startTime;
	}
	
	/**
	 * @return the $endTime
	 */
	public function getEndTime(){
		return $this->endTime;
	}
	
	/**
	 * @return the $privilege
	 */
	public function getPrivilege(){
		return $this->privilege;
	}
	
	/**
	 * @return the $providerType
	 */
	public function getProviderType(){
		return $this->providerType;
	}
	
	/**
	 * @return the $securityLevel
	 */
	public function getSecurityLevel(){
		return $this->securityLevel;
	}
	
	/**
	 * @param $id the $id to set
	 */
	public function setId($id){
		$this->id = $id;
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
	 * @param $metaId the $metaId to set
	 */
	public function setMetaId($metaId){
		$this->metaId = $metaId;
	}
	
	/**
	 * @param $factoryId the $factoryId to set
	 */
	public function setFactoryId($factoryId){
		$this->factoryId = $factoryId;
	}
	
	/**
	 * @param $parameters the $parameters to set
	 */
	public function setParameters($parameters){
		$this->parameters = $parameters;
	}
	
	/**
	 * @param $startTime the $startTime to set
	 */
	public function setStartTime($startTime){
		$this->startTime = $startTime;
	}
	
	/**
	 * @param $endTime the $endTime to set
	 */
	public function setEndTime($endTime){
		$this->endTime = $endTime;
	}
	
	/**
	 * @param $privilege the $privilege to set
	 */
	public function setPrivilege($privilege){
		$this->privilege = $privilege;
	}
	
	/**
	 * @param $providerType the $providerType to set
	 */
	public function setProviderType($providerType){
		$this->providerType = $providerType;
	}
	
	/**
	 * @param $securityLevel the $securityLevel to set
	 */
	public function setSecurityLevel($securityLevel){
		$this->securityLevel = $securityLevel;
	}
	/**
	 * @return the $providerKey
	 */
	public function getProviderKey(){
		return $this->providerKey;
	}

	/**
	 * @param $providerKey the $providerKey to set
	 */
	public function setProviderKey($providerKey){
		$this->providerKey = $providerKey;
	}


}

?>