<?php
include_once '../../marketing.internal/MetaDataHandler.php';

class MarketingToolHandler {
	
	/**
	 * @param $marketingTool
	 * @return array
	 */
	static function serialize(MarketingTool $marketingTool){
		$result = array();
		$result['toolSchema'] = MetaConstants::TOOL_SCHEMA;
		$result['toolId'] = $marketingTool->getToolId();
		$result['name'] = $marketingTool->getName();
		$result['toolCode'] = $marketingTool->getToolCode();
		$result['description'] = $marketingTool->getDescription();
		$result['providerKey'] = $marketingTool->getProviderKey();
		$result['type'] = $marketingTool->getType();
		$result['privilege'] = $marketingTool->getPrivilege();
		$result['orderType'] = $marketingTool->getOrderType();
		$result['startTime'] = $marketingTool->getStartTime();
		$result['endTime'] = $marketingTool->getEndTime();
		
		$operation = MetaDataHandler::serialize($marketingTool->getOperationMeta());
		$operation['schema'] = MetaConstants::META_SCHEMA;
		$result['operation'] = $operation;
		return $result;
	}
	
	/**
	 * @param $result
	 * @return MarketingTool
	 */
	static function deserialize($result){
		$marketingTool = new MarketingTool();
		$marketingTool->setToolId($result['toolId']);
		$marketingTool->setName($result['name']);
		$marketingTool->setToolCode($result['toolCode']);
		$marketingTool->setDescription($result['description']);
		$marketingTool->setProviderKey($result['providerKey']);
		$marketingTool->setType($result['type']);
		$marketingTool->setPrivilege($result['privilege']);
		$marketingTool->setOrderType($result['orderType']);
		$marketingTool->setStartTime($result['startTime']);
		$marketingTool->setEndTime($result['endTime']);
		$marketingTool->setOperationMeta(MetaDataHandler::deserialize($result['operation']));
		return $marketingTool;
	}
}

?>