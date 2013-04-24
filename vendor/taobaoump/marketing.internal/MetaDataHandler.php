<?php
include_once '../../marketing.internal/ParameterValueHandler.php';

class MetaDataHandler {
	
	CONST TYPE_UNKNOWN = 'UNKNOWN';
	CONST TYPE_AND = 'AND';
	CONST TYPE_OR = 'OR';
	CONST TYPE_NOT = 'NOT';
	CONST TYPE_DUAL = 'DUAL';
	CONST TYPE_CONDITIONAL = 'CONDITIONAL';
	CONST TYPE_TARGET = 'TARGET';
	CONST TYPE_RANGE = 'RANGE';
	CONST TYPE_OPERATION = 'OPERATION';
	CONST TYPE_CONDITION = 'CONDITION';
	CONST TYPE_ACTION = 'ACTION';
	CONST TYPE_RESOURCE = 'RESOURCE';
	
	/**
	 * @param $metaData
	 * @return array
	 */
	static function serialize(MetaData $metaData){
		$type = self::getType($metaData);
		$result = array();
		$result['type'] = $type;
		switch ($type) {
			case MetaDataHandler::TYPE_AND :
			case MetaDataHandler::TYPE_OR :
			case MetaDataHandler::TYPE_NOT :
				$tmps = self::serializeCompositeMeta($metaData);
				$result = array_merge($result, $tmps);
				break;
			case MetaDataHandler::TYPE_DUAL :
				$tmps = self::serializeDualMeta($metaData);
				$result = array_merge($result, $tmps);
				break;
			case MetaDataHandler::TYPE_CONDITIONAL :
				$tmps = self::serializeCompositeMeta($metaData, $result);
				$params = $metaData->getParameterValues();
				$param = $params[0];
				$result['paramId'] = $param->getId();
				$result = array_merge($result, $tmps);
				break;
			case MetaDataHandler::TYPE_TARGET :
			case MetaDataHandler::TYPE_RANGE :
			case MetaDataHandler::TYPE_OPERATION :
			case MetaDataHandler::TYPE_CONDITION :
			case MetaDataHandler::TYPE_ACTION :
			case MetaDataHandler::TYPE_RESOURCE :
				$result['metaId'] = $metaData->getMetaDef()->getId();
				$params = array();
				if ( $metaData->getParameterValues() != null ) {
					foreach( $metaData->getParameterValues() as $param ) {
						$params[] = ParameterValueHandler::serialize($param);
					}
				}
				$result['params'] = $params;
				if ( $metaData->getTradeStatus() != null ) {
					$result['tradeStatus'] = $metaData->getTradeStatus();
				}
				break;
		}
		return $result;
	}
	
	private static function getType($metaData){
		if ( $metaData instanceof LogicAndMetaData ) {
			return MetaDataHandler::TYPE_AND;
		
		} elseif ( $metaData instanceof LogicOrMetaData ) {
			return MetaDataHandler::TYPE_OR;
		
		} elseif ( $metaData instanceof LogicNotMetaData ) {
			return MetaDataHandler::TYPE_NOT;
		
		} elseif ( $metaData instanceof DualMetaData ) {
			return MetaDataHandler::TYPE_DUAL;
		
		} elseif ( $metaData instanceof ConditionalMetaData ) {
			return MetaDataHandler::TYPE_CONDITIONAL;
		
		} else {
			$metaDef = $metaData->getMetaDef();
			if ( $metaDef instanceof TargetDef ) {
				return MetaDataHandler::TYPE_TARGET;
			
			} elseif ( $metaDef instanceof RangeDef ) {
				return MetaDataHandler::TYPE_RANGE;
			
			} elseif ( $metaDef instanceof ConditionDef ) {
				return MetaDataHandler::TYPE_CONDITION;
			
			} elseif ( $metaDef instanceof ActionDef ) {
				return MetaDataHandler::TYPE_ACTION;
			
			} elseif ( $metaDef instanceof ResourceDef ) {
				return MetaDataHandler::TYPE_RESOURCE;
			
			} elseif ( $metaDef instanceof OperationDef ) {
				return MetaDataHandler::TYPE_OPERATION;
			
			} else {
				return MetaDataHandler::TYPE_UNKNOWN;
			}
		}
	}
	
	private static function serializeCompositeMeta($metaData){
		$metaDatas = $metaData->getElements();
		$elements = array();
		foreach( $metaDatas as $meta ) {
			$elements[] = self::serialize($meta);
		}
		$result = array();
		$result['elements'] = $elements;
		return $result;
	}
	
	private static function serializeDualMeta($metaData){
		$result = array();
		$result['condition'] = self::serialize($metaData->getFirst());
		$result['action'] = self::serialize($metaData->getSecond());
		return $result;
	}
	
	/**
	 * @param array $result
	 * @return MetaData
	 */
	static function deserialize($result){
		$type = $result['type'];
		switch ($type) {
			case MetaDataHandler::TYPE_AND :
				return new LogicAndMetaData(self::deserializeMetaDataList($result));
			
			case MetaDataHandler::TYPE_OR :
				return new LogicOrMetaData(self::deserializeMetaDataList($result));
			
			case MetaDataHandler::TYPE_NOT :
				return new LogicNotMetaData(self::deserializeMetaDataList($result));
			
			case MetaDataHandler::TYPE_DUAL :
				return self::deserializeDualMetaData($result);
			
			case MetaDataHandler::TYPE_CONDITIONAL :
				return self::deserializeConditionalMetaData($result);
			
			case MetaDataHandler::TYPE_TARGET :
			case MetaDataHandler::TYPE_RANGE :
			case MetaDataHandler::TYPE_OPERATION :
			case MetaDataHandler::TYPE_CONDITION :
			case MetaDataHandler::TYPE_ACTION :
			case MetaDataHandler::TYPE_RESOURCE :
				return self::deserializeResourceMetaData($result);
		}
		throw new MarketingException("未知的 MetaData类型: " . type);
	}
	
	private static function deserializeMetaDataList($result){
		$list = array();
		$elements = $result['elements'];
		foreach( $elements as $element ) {
			$list[] = self::deserialize($element);
		}
		return $list;
	}
	
	private static function deserializeDualMetaData($result){
		$condition = self::deserialize($result['condition']);
		$action = self::deserialize($result['action']);
		return new DualMetaData($condition, $action);
	}
	
	private static function deserializeConditionalMetaData($result){
		$list = self::deserializeMetaDataList($result);
		$metaData = $list[0];
		$paramId = $result['paramId'];
		return new ConditionalMetaData($metaData, $paramId);
	}
	
	private static function deserializeResourceMetaData($result){
		$type = $result['type'];
		$metaId = $result['metaId'];
		$params = $result['params'];
		$tradeStatus = null;
		if ( array_key_exists('tradeStatus', $result) ) {
			$tradeStatus = $result['tradeStatus'];
		}
		$metaDef = null;
		if ( $type == MetaDataHandler::TYPE_TARGET ) {
			$metaDef = new TargetDef($metaId);
		
		} elseif ( $type == MetaDataHandler::TYPE_RANGE ) {
			$metaDef = new RangeDef($metaId);
		
		} elseif ( $type == MetaDataHandler::TYPE_CONDITION ) {
			$metaDef = new ConditionDef($metaId);
		
		} elseif ( $type == MetaDataHandler::TYPE_ACTION ) {
			$metaDef = new ActionDef($metaId);
		
		} elseif ( $type == MetaDataHandler::TYPE_RESOURCE ) {
			$metaDef = new ResourceDef($metaId);
		
		} elseif ( $type == MetaDataHandler::TYPE_OPERATION ) {
			$metaDef = new OperationDef($metaId);
		}
		$paramValus = array();
		foreach( $params as $param ) {
			$paramValus[] = ParameterValueHandler::deserialize($param);
		}
		return new MetaData($metaDef, $paramValus, $tradeStatus);
	}
}

?>