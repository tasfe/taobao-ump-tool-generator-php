<?php
include_once '../../marketing.internal/MarketingToolHandler.php';

class JsonUtil {
	
	public static function toJson($obj){
		$json = null;
		if ( $obj instanceof MarketingTool ) {
			$marketingToolHandler = new MarketingToolHandler();
			$tmps = $marketingToolHandler->serialize($obj);
			$json = json_encode($tmps);
		}
		return $json;
	}
	
	public static function fromJson($obj){
	
	}
	
	private static function toArray($obj){
		$arr = JsonUtil::objToArray($obj);
		foreach( $arr as $key => $value ) {
			if ( is_object($value) ) {
				$arr[$key] = JsonUtil::toArray($value);
			}
		}
		return $arr;
	}
	
	private static function objToArray($obj){
		$reflect = new ReflectionObject($obj);
		$reflectMethods = $reflect->getMethods();
		$reflectProperties = $reflect->getProperties();
		
		$resultArray = array();
		$publicMethods = array();
		foreach( $reflectMethods as $method ) {
			if ( $method->isPublic() && JsonUtil::isGetterMethod($method->getName()) ) {
				$publicMethods[$method->getName()] = $method;
			}
		}
		
		foreach( $reflectProperties as $property ) {
			$propertyName = $property->getName();
			if ( $property->isPublic() ) {
				$propertyValue = $property->getValue($obj);
			} else {
				$methodName = JsonUtil::getMethodName($propertyName);
				$method = $publicMethods[$methodName];
				if ( $method ) {
					$propertyValue = $method->invoke($obj, null);
				} else {
					$propertyValue = null;
				}
			}
			if ( is_array($propertyValue) ) {
				for( $index = 0; $index < count($propertyValue); $index ++ ) {
					if ( is_object($propertyValue[$index]) ) {
						$propertyValue[$index] = JsonUtil::objToArray($propertyValue[$index]);
					}
				}
			} elseif ( is_object($propertyValue) ) {
				$propertyValue = JsonUtil::objToArray($propertyValue);
			}
			$resultArray[$propertyName] = $propertyValue;
		}
		return $resultArray;
	}
	
	private static function isGetterMethod($methodName){
		//   return 0==stripos($methodName , 'get') ;
		return preg_match('/^get.*/', $methodName);
	}
	
	private static function getMethodName($propertyName){
		$h = substr($propertyName, 0, 1);
		$b = substr($propertyName, 1);
		$h = strtoupper($h);
		return 'get' . $h . $b;
	}

}

?>