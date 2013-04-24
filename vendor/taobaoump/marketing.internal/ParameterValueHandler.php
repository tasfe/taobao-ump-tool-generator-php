<?php

class ParameterValueHandler {
	
	/**
	 * @param $param
	 * @return array
	 */
	static function serialize(ParameterValue $param){
		$kind = $param->getKind();
		$result = array();
		$result['paramId'] = $param->getId();
		$result['kind'] = $kind;
		switch ($kind) {
			case ParameterValue::KIND_DEFINED :
				$paramDef = $param->getParameterDef();
				$valueType = $paramDef->getValueType();
				$isArray = $paramDef->isArray();
				$result['type'] = $valueType;
				if ( $isArray ) {
					$result['array'] = $isArray;
				}
				$result['value'] = $param->getValue();
				break;
			case ParameterValue::KIND_RESOURCE :
				$result['value'] = MetaDataHandler::serialize($param->getValue());
				break;
			case ParameterValue::KIND_UNDEFINE :
				break;
		}
		return $result;
	}
	
	/**
	 * @param array $result
	 * @return ParameterValue
	 */
	static function deserialize($result){
		$isArray = false;
		$paramId = $result['paramId'];
		$kind = $result['kind'];
		switch ($kind) {
			case ParameterValue::KIND_DEFINED :
				if ( array_key_exists('array', $result) ) {
					$isArray = $result['array'];
				}
				$type = $result['type'];
				$value = $result['value'];
				$paramDef = new ParameterDef(null, $type, null, $isArray);
				return new ParameterValue($paramId, $paramDef, null, $kind, $value);
			case ParameterValue::KIND_RESOURCE :
				$value = $result['value'];
				$metaData = MetaDataHandler::deserialize($value);
				return new ParameterValue($paramId, null, null, $kind, $value);
			case ParameterValue::KIND_UNDEFINE :
				return new ParameterValue($paramId, null, null, $kind, null);
		}
		throw new MarketingException("未知的 kind类型: " . $kind);
	}
}

?>