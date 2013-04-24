<?php
include_once '../../marketing/ParameterValueDefiner.php';

/**
 * 活动详情，是营销工具被具体实施的实例，营销工具的所有缺少的为定义参数都必须填入
 * @see MarketingTool
 * @author taobao 2011-4-22 下午02:35:05
 */
class MarketingDetail extends ParameterValueDefiner {
	
	/** 优惠范围，指定商品 */
	CONST RANGE_TYPE_ITEM = 'ITEM';
	/** 优惠范围，指定店铺 */
	CONST RANGE_TYPE_SHOP = 'SHOP';
	/** 优惠范围，指定卖家 */
	CONST RANGE_TYPE_SELLER = 'SELLER';
	/** 优惠范围，指定商品SKU */
	CONST RANGE_TYPE_SKU = 'SKU';
	/** 优惠范围，指定全网类目 */
	CONST RANGE_TYPE_CATEGORY = 'CATEGORY';
	/** 优惠范围，指定店铺类目 */
	CONST RANGE_TYPE_SHOP_CATEGORY = 'SHOP_CATEGORY';
	
	/** 活动详情状态，正常  */
	CONST DETAIL_TYPE_NORMAL = 'NORMAL';
	/** 活动详情状态，冻结  */
	CONST DETAIL_TYPE_FROZEN = 'FROZEN';
	/** 活动详情状态，删除  */
	CONST DETAIL_TYPE_DELETE = 'DELETE';
	
	private $activity;
	private $startTime;
	private $endTime;
	private $status=self::DETAIL_TYPE_NORMAL;
	private $participateType;
	private $participateId;
	
	public function initDetailParams($params = array()){
		$definable = null;
		if ( $this->activity == null || $this->activity->getTool() == null ) {
			$definable = array();
		} else {
			$tool = $this->activity->getTool();
			$definable = $tool->getDefinableParams();
		}
		$this->initParams($params, $definable);
	}
	
	/**
	 * @return the $activity
	 */
	public function getActivity(){
		return $this->activity;
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
	 * @return the $participateType
	 */
	public function getParticipateType(){
		return $this->participateType;
	}
	
	/**
	 * @return the $participateId
	 */
	public function getParticipateId(){
		return $this->participateId;
	}
	
	/**
	 * @param $activity the $activity to set
	 */
	public function setActivity($activity){
		$this->activity = $activity;
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
	 * @param $participateType the $participateType to set
	 */
	public function setParticipateType($participateType){
		$this->participateType = $participateType;
	}
	
	/**
	 * @param $participateId the $participateId to set
	 */
	public function setParticipateId($participateId){
		$this->participateId = $participateId;
	}

}

?>