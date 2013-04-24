<?php
include_once '../../marketing.internal/ParameterValueHandler.php';

class MetaDataHandler {
	
	/**
	 * @param $metaDef
	 * @return array
	 */
	static function serialize(MetaDef $metaDef){
		$result = array();
		//		$result['id'] = $metaDef->getId();
		//		$result['name'] = $metaDef->getName();
		//		$result['desc'] = $metaDef->getDesc();
		//		$result['metaId'] = $metaDef->getMetaId();
		//		$result['factoryId'] = $metaDef->getFactoryId();
		//		$result['parameters'] = $metaDef->getParameters();
		//		$result['startTime'] = $metaDef->getStartTime();
		//		$result['endTime'] = $metaDef->getEndTime();
		//		$result['privilege'] = $metaDef->getPrivilege();
		//		$result['providerType'] = $metaDef->getProviderType();
		//		$result['securityLevel'] = $metaDef->getSecurityLevel();
		//		$result['metaType'] = '';
		//		$result['resultParam'] = '';
		//		$result['defaultStatus'] = '';
		//		$result['defaultStatus'] = '';
		return $result;
	}
	
	/**
	 * @param array $result
	 * @return MetaDef
	 */
	static function deserialize($result){
		$id = $result['id'];
		$name = $result['name'];
		$desc = $result['desc'];
		$parameters = $result['parameters'];
		$metaType = $result['metaType'];
		$metaDef = null;
		if ( $metaType == 'com.taobao.ump.client.meta.ConditionDef' ) {
			$metaDef = new ConditionDef($id, $parameters, $desc);
			
		} elseif ( $metaType == 'com.taobao.ump.client.meta.ActionDef' ) {
			$metaDef = new ActionDef();
			
		} elseif ( $metaType == 'com.taobao.ump.client.meta.TargetDef' ) {
			$metaDef = new TargetDef();
			
		} elseif ( $metaType == 'com.taobao.ump.client.meta.ResourceDef' ) {
			$metaDef = new ResourceDef();
			
		} else {
			return null;
		}
	}

}

?>