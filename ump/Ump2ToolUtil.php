<?php
class Ump2ToolUtil {
	/**
	 * @var TopClientBase
	 */
	private static $topClient;
	public static function findMbbIdByCode($code){
		$jsonArr=self::findMbbByCode($code);
		return $jsonArr['id'];
	}
	
	public static function findMbbByCode($code){
		$request=new UmpMbbGetbycodeRequest();
		$request->setCode($code);
		$r=self::execute($request);
		$jsonArr=json_decode($r->mbb,true);
		return $jsonArr;
	}
	
	
	public static function addTool($json){
		$request=new UmpToolAddRequest();
		$request->setContent($json);
		$r=self::execute($request);
		return $r->tool_id;
	}
	
	public static function getTool($toolId){
		$request=new UmpToolGetRequest();
		$request->setToolId($toolId);
		$r=self::execute($request);
		return $r->content;
	}
	
	public static function checkTool($toolId){
		$request=new PromotionmiscToolCheckRequest();
		$request->setToolId($toolId);
		$r=self::execute($request); 
		return $r;
	}
	
	
	private static function execute($request,$session=null){
		//if ($session===false) $session=self::getScopeSession(); //do not need session support
		if (self::$topClient===null){
			self::$topClient=new TopClientBase(TAOBAO_APIKEY,TAOBAO_APP_SECRET);
			if (TAOBAO_SANDBOX){
				self::$topClient->gatewayUrl='http://gw.api.tbsandbox.com/router/rest';
			}
		}
		return self::$topClient->execute($request,$session);
	}
}

?>