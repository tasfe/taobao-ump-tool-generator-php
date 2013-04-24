<?php

/**
 * 营销工具
 * @author taobao 2011-4-22 下午02:35:05
 */
class MarketingTool {
	
	/** 针对子订单级别的工具 */
	CONST TOOL_TYPE_SUB_ORDER = 'SUB_ORDER';
	/** 针对主订单级别的工具 */
	CONST TOOL_TYPE_ORDER = 'ORDER';
	/** 针对跨订单级别的工具 */
	CONST TOOL_TYPE_ACROSS_ORDER = 'ACROSS_ORDER';
	
	/** 私有工具  */
	CONST PRIVILEGE_TYPE_PRIVATE = 'PRIVATE';
	/** 对外公开  */
	CONST PRIVILEGE_TYPE_PUBLIC = 'PUBLIC';
	
	/** 不可被卖家订购  */
	CONST ORDER_TYPE_UNORDERABLE = 'UNORDERABLE';
	/** 可被卖家订购  */
	CONST ORDER_TYPE_ORADERABLE = 'ORADERABLE';
	
	private $toolId;
	private $name;
	private $toolCode;
	private $description;
	private $providerKey;
	private $type;
	private $privilege = MarketingTool::PRIVILEGE_TYPE_PRIVATE;
	private $orderType = MarketingTool::ORDER_TYPE_UNORDERABLE;
	private $startTime;
	private $endTime;
	private $operationMeta;
	
	/**
	 * @param $metaData
	 */
	public function getAllParams($metaData = null){
		if ( $metaData == null ) {
			$metaData = $this->operationMeta;
		}
		$params = array();
		if ( $metaData instanceof CompositeMetaData ) {
			$elements = $metaData->getElements();
			foreach( $elements as $e ) {
				if ( $e instanceof ConditionalMetaData ) {
					$tmps = $this->getAllParams($e->getElement());
					$params = array_merge($params, $tmps);
				}
				if ( $e->getParameterValues() != null ) {
					$tmps = array();
					foreach( $e->getParameterValues() as $param ) {
						$tmps[$param->getId()] = $param;
					}
					$params = array_merge($params, $tmps);
				} else {
					$tmps = $this->getAllParams($e);
					$params = array_merge($params, $tmps);
				}
			}
		} else {
			foreach( $metaData->getParameterValues() as $param ) {
				$params[$param->getId()] = $param;
			}
		}
		return $params;
	}
	
	public function getDefinableParams(){
		$definable = array();
		$params = $this->getAllParams();
		foreach( $params as $param ) {
			if ( $param->getKind() == ParameterValue::KIND_UNDEFINE ) {
				$definable[$param->getId()] = $param;
			}
		}
		return $definable;
	}
	
	/**
	 * @return the $name
	 */
	public function getName(){
		return $this->name;
	}
	
	/**
	 * @return the $toolCode
	 */
	public function getToolCode(){
		return $this->toolCode;
	}
	
	/**
	 * @return the $description
	 */
	public function getDescription(){
		return $this->description;
	}
	
	/**
	 * @return the $type
	 */
	public function getType(){
		return $this->type;
	}
	
	/**
	 * @return the $privilege
	 */
	public function getPrivilege(){
		return $this->privilege;
	}
	
	/**
	 * @return the $orderType
	 */
	public function getOrderType(){
		return $this->orderType;
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
	 * @return the $operationMeta
	 */
	public function getOperationMeta(){
		return $this->operationMeta;
	}
	
	/**
	 * @param $name the $name to set
	 */
	public function setName($name){
		$this->name = $name;
	}
	
	/**
	 * @param $toolCode the $toolCode to set
	 */
	public function setToolCode($toolCode){
		$this->toolCode = $toolCode;
	}
	
	/**
	 * @param $description the $description to set
	 */
	public function setDescription($description){
		$this->description = $description;
	}
	
	/**
	 * @param $type the $type to set
	 */
	public function setType($type){
		$this->type = $type;
	}
	
	/**
	 * @param $privilege the $privilege to set
	 */
	public function setPrivilege($privilege){
		$this->privilege = $privilege;
	}
	
	/**
	 * @param $orderType the $orderType to set
	 */
	public function setOrderType($orderType){
		$this->orderType = $orderType;
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
	 * @param $operationMeta the $operationMeta to set
	 */
	public function setOperationMeta($operationMeta){
		$this->operationMeta = $operationMeta;
	}
	/**
	 * @return the $toolId
	 */
	public function getToolId(){
		return $this->toolId;
	}
	
	/**
	 * @return the $providerKey
	 */
	public function getProviderKey(){
		return $this->providerKey;
	}
	
	/**
	 * @param $toolId the $toolId to set
	 */
	public function setToolId($toolId){
		$this->toolId = $toolId;
	}
	
	/**
	 * @param $providerKey the $providerKey to set
	 */
	public function setProviderKey($providerKey){
		$this->providerKey = $providerKey;
	}

}

?>