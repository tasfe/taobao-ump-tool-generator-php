<?php
include_once '../../marketing/MarketingBuilder.php';
include_once '../../marketing.meta/MetaConstants.php';
include_once '../../marketing.meta/MetaData.php';
include_once '../../marketing.meta/ResourceDef.php';
include_once '../../marketing.meta/ConditionDef.php';
include_once '../../marketing.meta/ActionDef.php';
include_once '../../marketing.meta/TargetDef.php';
include_once '../../marketing.test/TaobaoClient.php';
include_once '../../marketing.test/TaobaoQuery.php';

class BuildTest {
	
	public function findMetaByCode($code){
		$taobaoQuery = new TaobaoQuery('taobao.ump.mbb.getbycode', 'xml');
		$taobaoQuery->setParam('code', $code);
		$taobaoClient = new TaobaoClient();
		$taobaoResult = $taobaoClient->execute($taobaoQuery);
		return $taobaoResult->mbb;
	}
	
	public function findToolByToolId($toolId){
		$taobaoQuery = new TaobaoQuery('taobao.ump.tool.get', 'xml');
		$taobaoQuery->setParam('tool_id', $toolId);
		
		$taobaoClient = new TaobaoClient();
		$taobaoResult = $taobaoClient->execute($taobaoQuery);
		$toolJson = $taobaoResult->content;
		return $toolJson;
	}
	
	public function findActivityByActId($actId){
		$taobaoQuery = new TaobaoQuery('taobao.ump.activity.get', 'xml');
		$taobaoQuery->setParam('act_id', $actId);
		
		$taobaoClient = new TaobaoClient();
		$taobaoResult = $taobaoClient->execute($taobaoQuery);
		$activityJson = $taobaoResult->content;
		return $activityJson;
	}
	
	public function findDetailByDetailId($detailId){
		$taobaoQuery = new TaobaoQuery('taobao.ump.detail.get', 'xml');
		$taobaoQuery->setParam('detail_id', $detailId);
		
		$taobaoClient = new TaobaoClient();
		$taobaoResult = $taobaoClient->execute($taobaoQuery);
		$detailJson = $taobaoResult->content;
		return $detailJson;
	}
	
	public function buildMjjTool(){
		$builder = new MarketingBuilder();
		
		//获得订单价格
		$orderPriceDef = new ResourceDef(237); //com.taobao.ump.meta.resource.getOrderPriceResource
		$orderPriceMetaData = $builder->bind($orderPriceDef, array($builder->newBooleanParameter(true)));
		
		//满多少元
		$amountConditionDef = new ConditionDef(219); //com.taobao.ump.condition.amountOver
		$amountMetaData = $builder->bind($amountConditionDef, array($builder->newResourceParameter($orderPriceMetaData), $builder->newUndefineParameter('totalPrice'), $builder->newUndefineParameter('enableMultiple')));
		
		//减多少钱
		$decreaseActionDef = new ActionDef(203); //com.taobao.ump.meta.action.decreaseMoney
		$decreaseMetaData = $builder->bind($decreaseActionDef, array($builder->newUndefineParameter('decreaseMoney')));
		$builder->bindTradeStatus($decreaseMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		$decreaseMetaData = $builder->bindConditional($decreaseMetaData, 'decrease');
		
		//打折
		$discountActionDef = new ActionDef(204); //com.taobao.ump.meta.action.discount
		$discountMetaData = $builder->bind($discountActionDef, array($builder->newUndefineParameter('discountRate'), $builder->newUndefineParameter('price')));
		$builder->bindTradeStatus($discountMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		$discountMetaData = $builder->bindConditional($discountMetaData, 'discount');
		
		//免邮
//		$freePostActionDef = new ActionDef(205); //com.taobao.ump.meta.action.freePostage
//		$freePostMetaData = $builder->bind($freePostActionDef);
//		$builder->bindTradeStatus($freePostMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
//		$freePostMetaData = $builder->bindConditional($freePostMetaData, 'freepost');
		
		$operationMetaData = $decreaseMetaData->logicAnd($discountMetaData);
//		$operationMetaData = $operationMetaData->logicAnd($freePostMetaData);
		$promotionMetaData = $builder->bindAction($amountMetaData, $operationMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('林逍测试 phpmjj');
		$tool->setDescription('林逍测试 phpmjj');
		$tool->setToolCode('linxiaophpmjj' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		
		$json = $builder->buildTool($tool);
		print_r($json);
		print_r('<br/>');
		//$result = $builder->loadTool($json);
		$taobaoQuery = new TaobaoQuery('taobao.ump.tool.add', 'xml');
		$taobaoQuery->setParam('content', $json);
		$taobaoClient = new TaobaoClient();
		$taobaoResult = $taobaoClient->execute($taobaoQuery);
		print_r($taobaoResult);
	}
	
	public function buildMjjActivity($toolId){
		$builder = new MarketingBuilder();
		$toolJson = $this->findToolByToolId($toolId);
		$tool = $builder->loadTool($toolJson);
		
		//$usetTagJson = $this->findMetaByCode('com.taobao.ump.meta.target.userTag');
//		$targetDef = new TargetDef(129); //com.taobao.ump.meta.target.userTag
//		$targetMeta = $builder->bind($targetDef, array($builder->newStringParameter('110')));
		
		$activity = $builder->createActivity($tool);
//		$activity->setTarget($targetMeta);
		$activity->setName('林逍phpmjj测试');
		$activity->setDescription('林逍phpmjj测试的描述');
		//print_r($marketingActivity);
		

		$activityJson = $builder->buildActivity($activity);
		
		$taobaoQuery = new TaobaoQuery('taobao.ump.activity.add', 'xml');
		$taobaoQuery->setParam('tool_id', $toolId);
		$taobaoQuery->setParam('content', $activityJson);
		
		$taobaoClient = new TaobaoClient();
		$taobaoResult = $taobaoClient->execute($taobaoQuery);
		print_r($taobaoResult);
	}
	
	public function bulidMjjDetail($toolId, $actId){
		$builder = new MarketingBuilder();
		$toolJson = $this->findToolByToolId($toolId);
		$tool = $builder->loadTool($toolJson);
		
		$activityJson = $this->findActivityByActId($actId);
		$activity = $builder->loadActivity($tool, $activityJson);
		
		$detail = $builder->createDetail($activity);
		$detail->define('decreaseMoney', '30', ParameterDef::VALUE_TYPE_LONG);
		$detail->define('discountRate', '30', ParameterDef::VALUE_TYPE_LONG);
		$detail->define('price', '30', ParameterDef::VALUE_TYPE_LONG);
		$detail->define('enableMultiple', true, ParameterDef::VALUE_TYPE_BOOLEAN);
		$detail->define('totalPrice', '100', ParameterDef::VALUE_TYPE_LONG);
		$detail->define('decrease', true, ParameterDef::VALUE_TYPE_BOOLEAN);
		$detail->define('discount', false, ParameterDef::VALUE_TYPE_BOOLEAN);
		$detail->define('freepost', false, ParameterDef::VALUE_TYPE_BOOLEAN);
		$detailJson = $builder->buildDetail($detail);
		
		$taobaoQuery = new TaobaoQuery('taobao.ump.detail.add', 'xml');
		$taobaoQuery->setParam('act_id', $actId);
		$taobaoQuery->setParam('content', $detailJson);
		
		$taobaoClient = new TaobaoClient();
		$taobaoResult = $taobaoClient->execute($taobaoQuery);
		print_r($taobaoResult);
	}
}

?>