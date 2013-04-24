<?php
include_once '../../marketing.meta/MetaDef.php';
/**
 * 操作的元数据定义
 * @author taobao 2011-4-22 下午07:09:51
 */
class ActionDef extends MetaDef {
	
	private $defaultStatus;
	private $allowedStatuses;
	
	public function ActionDef($id, $parameters = array(), $desc = null, $defaultStatus = null, $allowedStatuses = null){
		$this->MetaDef($id, $parameters, $desc);
		$this->defaultStatus = $defaultStatus;
		$this->allowedStatuses = $allowedStatuses;
	}
	
	/**
	 * @return the $defaultStatus
	 */
	public function getDefaultStatus(){
		return $this->defaultStatus;
	}
	
	/**
	 * @return the $allowedStatuses
	 */
	public function getAllowedStatuses(){
		return $this->allowedStatuses;
	}
	
	/**
	 * @param $defaultStatus the $defaultStatus to set
	 */
	public function setDefaultStatus($defaultStatus){
		$this->defaultStatus = $defaultStatus;
	}
	
	/**
	 * @param $allowedStatuses the $allowedStatuses to set
	 */
	public function setAllowedStatuses($allowedStatuses){
		$this->allowedStatuses = $allowedStatuses;
	}

}

?>