<?php

class MarketingDetailHandler {
	
	/**
	 * @param MarketingDetail $marketingDetail
	 * @return array
	 */
	static function serialize(MarketingDetail $marketingDetail){
		$result = array();
		$result['detailSchema'] = MetaConstants::DETAIL_SCHEMA;
		$result['participateType'] = $marketingDetail->getParticipateType();
		$result['participateId'] = $marketingDetail->getParticipateId();
		$result['startTime'] = $marketingDetail->getStartTime();
		$result['endTime'] = $marketingDetail->getEndTime();
		$result['status'] = $marketingDetail->getStatus();
		$params = array();
		foreach( $marketingDetail->getDefinedParameters() as $param ) {
			$params[] = ParameterValueHandler::serialize($param);
		}
		$result['operation'] = $params;
		return $result;
	}
	
	/**
	 * @param $json
	 * @return MarketingDetail
	 */
	static function deserialize($result){
		$marketingDetail = new MarketingDetail();
		$marketingDetail->setParticipateType($result['participateType']);
		$marketingDetail->setParticipateId($result['participateId']);
		$marketingDetail->setStartTime($result['startTime']);
		$marketingDetail->setEndTime($result['endTime']);
		$marketingDetail->setStatus($result['status']);
		$params = $result['operation'];
		$defined = array();
		foreach( $params as $param ) {
			$defined[] = ParameterValueHandler::deserialize($param);
		}
		$marketingDetail->initParams($defined);
		return $marketingDetail;
	}
}

?>