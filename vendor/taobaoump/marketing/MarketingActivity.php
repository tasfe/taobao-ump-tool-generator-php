<?php

include_once '../../marketing/ParameterValueDefiner.php';

/**
 * 营销活动，是营销工具被具体实施的一个活动
 * @author taobao 2011-4-22 下午02:35:05
 */
class MarketingActivity extends ParameterValueDefiner {
	
	/** 活动类型，不对外公开  */
	const ACTIVITY_TYPE_PRIVATE = 'PRIVATE';
	/** 活动类型，对外公开  */
	const ACTIVITY_TYPE_PUBLIC = 'PUBLIC';
	
	/** 活动状态，正常  */
	const ACTIVITY_TYPE_NORMAL = 'NORMAL';
	/** 活动类型，冻结  */
	const ACTIVITY_TYPE_FROZEN = 'FROZEN';
	/** 活动类型，删除  */
	const ACTIVITY_TYPE_DELETE = 'DELETE';
	
	/** 优惠范围的参与情况，全部参与 */
	const PARTICIPATE_RANGE_ALL = 'ALL';
	/** 优惠范围的参与情况，可部分商品参与 */
	const PARTICIPATE_RANGE_PART = 'PART';
	/** 优惠范围的参与情况，可部分商品不参与 */
	const PARTICIPATE_RANGE_PART_NOT = 'PART_NOT';
	
	/** 是否一次性活动 0:多次的活动 */
	const OPTIONS_MANYTIMES = 0;
	/** 是否一次性活动 1:一次性的活动 */
	const OPTIONS_ONCE = 1;
	
	private $tool;
	private $name;
	private $description;
	private $type = self::ACTIVITY_TYPE_PRIVATE;
	private $participateRange;
	private $target;
	private $startTime;
	private $endTime;
	private $status = self::ACTIVITY_TYPE_NORMAL;
	private $options = self::OPTIONS_MANYTIMES;
	
	public function initActivityParams($params = array()){
		$definable = null;
		if ( $this->tool == null ) {
			$definable = array();
		} else {
			$definable = $this->tool->getDefinableParams();
		}
		$this->initParams($params, $definable);
	}
	
	/**
	 * @return the $tool
	 */
	public function getTool(){
		return $this->tool;
	}
	
	/**
	 * @return the $name
	 */
	public function getName(){
		return $this->name;
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
	 * @return the $participateRange
	 */
	public function getParticipateRange(){
		return $this->participateRange;
	}
	
	/**
	 * @return the $target
	 */
	public function getTarget(){
		return $this->target;
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
	 * @return the $status
	 */
	public function getStatus(){
		return $this->status;
	}
	
	/**
	 * @return the $options
	 */
	public function getOptions(){
		return $this->options;
	}
	
	/**
	 * @param $tool the $tool to set
	 */
	public function setTool($tool){
		$this->tool = $tool;
	}
	
	/**
	 * @param $name the $name to set
	 */
	public function setName($name){
		$this->name = $name;
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
	 * @param $participateRange the $participateRange to set
	 */
	public function setParticipateRange($participateRange){
		$this->participateRange = $participateRange;
	}
	
	/**
	 * @param $target the $target to set
	 */
	public function setTarget($target){
		$this->target = $target;
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
	 * @param $status the $status to set
	 */
	public function setStatus($status){
		$this->status = $status;
	}
	
	/**
	 * @param $options the $options to set
	 */
	public function setOptions($options){
		$this->options = $options;
	}

}

?>