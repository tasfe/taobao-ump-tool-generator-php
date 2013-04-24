<?php

class MarketingActivityHandler {
	
	/**
	 * @param MarketingActivity $marketingActivity
	 * @return array
	 */
	static function serialize(MarketingActivity $marketingActivity){
		$result = array();
		$result['activitySchema'] = MetaConstants::ACTIVITY_SCHEMA;
		$result['name'] = $marketingActivity->getName();
		$result['description'] = $marketingActivity->getDescription();
		$result['type'] = $marketingActivity->getType();
		$result['participateRange'] = $marketingActivity->getParticipateRange();
		$result['options'] = $marketingActivity->getOptions();
		if ( $marketingActivity->getTarget() != null ) {
			$target = MetaDataHandler::serialize($marketingActivity->getTarget());
			$target['schema'] = MetaConstants::META_SCHEMA;
			$result['target'] = $target;
		}
		$result['startTime'] = $marketingActivity->getStartTime();
		$result['endTime'] = $marketingActivity->getEndTime();
		$result['status'] = $marketingActivity->getStatus();
		$params = array();
		foreach( $marketingActivity->getDefinedParameters() as $param ) {
			$params[] = ParameterValueHandler::serialize($param);
		}
		$result['operation'] = $params;
		return $result;
	}
	
	/**
	 * @param $result
	 * @return MarketingActivity
	 */
	static function deserialize($result){
		$marketingActivity = new MarketingActivity();
		$marketingActivity->setName($result['name']);
		$marketingActivity->setDescription($result['description']);
		$marketingActivity->setType($result['type']);
		$marketingActivity->setParticipateRange($result['participateRange']);
		$marketingActivity->setOptions($result['options']);
		if ( array_key_exists('target', $result) && $result['target'] != null ) {
			$marketingActivity->setTarget(MetaDataHandler::deserialize($result['target']));
		}
		$marketingActivity->setStartTime($result['startTime']);
		$marketingActivity->setEndTime($result['endTime']);
		$marketingActivity->setStatus($result['status']);
		$params = $result['operation'];
		$defined = array();
		foreach( $params as $param ) {
			$defined[] = ParameterValueHandler::deserialize($param);
		}
		$marketingActivity->initParams($defined);
		return $marketingActivity;
	}
}

?>