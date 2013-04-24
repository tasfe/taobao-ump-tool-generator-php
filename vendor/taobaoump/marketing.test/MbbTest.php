<?php
/*
 * Created on 2012-6-30
 * Xiaochuan
 */
 include_once '../../marketing/MarketingBuilder.php';
 include_once '../../marketing.meta/MetaConstants.php';
 include_once '../../marketing.meta/MetaData.php';
 include_once '../../marketing.meta/ResourceDef.php';
 include_once '../../marketing.meta/ConditionDef.php';
 include_once '../../marketing.meta/ActionDef.php';
 include_once '../../marketing.meta/TargetDef.php';
 include_once '../../marketing.test/TaobaoClient.php';
 include_once '../../marketing.test/TaobaoQuery.php';
 
 class MbbTest {
 	
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
	
	//大于
	public function conditionGreater(){ 
		$builder = new MarketingBuilder();
		
		//通过资源型营销积木块取得买家已经购买该促销商品的数量
		$purchasedCountDef = new ResourceDef(124); //com.taobao.ump.meta.resource.getBuyerAccumulatePurchasedCount
		$purchasedCountMetaData = $builder->bind($purchasedCountDef);
		
		//大于多少
		$greaterDef = new ConditionDef(134); //com.taobao.ump.meta.condition.greater
		$greaterMetaData = $builder->bind($greaterDef,array($builder->newResourceParameter($purchasedCountMetaData),$builder->newLongParameter(100)));
		
		//如果某个买家购买该物品超过100件，就包邮
		$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($greaterMetaData, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//小于
	public function conditionLess(){
		$builder = new MarketingBuilder();
		
		//通过资源型营销积木块取得买家已经购买该促销商品的数量
		$purchasedCountDef = new ResourceDef(124); //com.taobao.ump.meta.resource.getBuyerAccumulatePurchasedCount
		$purchasedCountMetaData = $builder->bind($purchasedCountDef);
		
		//小于多少
		$lessDef = new ConditionDef(135); //com.taobao.ump.meta.condition.less
		$lessMetaData = $builder->bind($lessDef,array($builder->newResourceParameter($purchasedCountMetaData),$builder->newLongParameter(100)));
		
		//如果某个买家购买该物品小于100件，就包邮
		$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($lessMetaData, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//等于
	public function conditionEquals(){
		$builder = new MarketingBuilder();
		
		//通过淘金币积木块取得买家的金币数量
		$coinCountDef = new ResourceDef(171603); //com.taobao.ump.meta.resource.getCoinResource
		$coinCountMetaDate = $builder->bind($coinCountDef);
		
		//等于多少
		$equalsDef = new ConditionDef(114); //com.taobao.ump.meta.condition.equals
		$equalsMetaData = $builder->bind($equalsDef,array($builder->newResourceParameter($coinCountMetaDate),$builder->newLongParameter(100)));
		
		//如果用户拥有100个淘金币就包邮
		$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($equalsMetaData, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//包含
	public function conditionContains(){
		$builder = new MarketingBuilder();
		
		//包含xxx
		$containsDef = new ConditionDef(136); //com.taobao.ump.meta.condition.contains
		$containsMetadate = $builder->bind($containsDef,array($builder->newUndefineParameter('z'),$builder->newLongParameter(100)));
		
		//如果包含100就包邮
		$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($containsMetadate, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//店铺会员等级检查
	public function conditionShopMember(){
		$builder = new MarketingBuilder();
		
		//会员等级检查
		$shopMemberDef = new ConditionDef(119); //com.taobao.ump.meta.condition.shopMember
		$shopMemberMetaDate = $builder->bind($shopMemberDef,array($builder->newLongParameter(1)));
		
		//如果是会员就减X元
		$decreaseMoneyDef = new ActionDef(102); //com.taobao.ump.meta.action.decreaseMoney
		$decreaseMoneyMetaDate = $builder->bind($decreaseMoneyDef,array($builder->newUndefineParameter('money')));
		$builder->bindTradeStatus($decreaseMoneyMetaDate, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($shopMemberMetaDate, $decreaseMoneyMetaDate);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//订单地址区域检查
	public function conditionExcludeArea(){
		$builder = new MarketingBuilder();
		
		//订单地址区域检查,对于北京和浙江的地区检查
		$excludeAreaDef = new ConditionDef(115); //com.taobao.ump.meta.condition.excludeArea
		$excludeAreaMetaData = $builder->bind($excludeAreaDef,array($builder->newStringParameter('100000*310000#北京*浙江')));
		
		//除北京和浙江地区包邮
		$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($excludeAreaMetaData->logicNot(), $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//满多少件
	public function conditionItemCountOver(){
		$builder = new MarketingBuilder();
		
		//满X件
		$itemCountOverDef = new ConditionDef(116); //com.taobao.ump.meta.condition.itemCountOver
		$itemCountOverMetaData = $builder->bind($itemCountOverDef,array($builder->newUndefineParameter('count'),$builder->newUndefineParameter('enableMultiple')));
		//这里的count和enableMultiple是指需要卖家参加活动时需要指定的参数信息
    	//当然可以也通过builder.newConstParameter(10)，设置成满10件就打折
    	
    	//包邮
    	$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($itemCountOverMetaData, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//满多少元
	public function conditionAmountOver(){
		$builder = new MarketingBuilder();
		
		//通过资源型营销积木块取得订单金额
		$orderPriceDef = new ResourceDef(127); //com.taobao.ump.meta.resource.getOrderPriceResource
		$orderPriceMetaData = $builder->bind($orderPriceDef, array($builder->newBooleanParameter(true)));
		
		//满X元
		$amountOverDef = new ConditionDef(113); //com.taobao.ump.meta.condition.amountOver
		$amountOverMetaData = $builder->bind($amountOverDef,array($builder->newResourceParameter($orderPriceMetaData),$builder->newUndefineParameter('totalPrice'),$builder->newUndefineParameter('enableMultiple')));
		//这里的totalPrice和enableMultiple是指需要卖家参加活动时需要指定的参数信息   
		//当然可以也通过builder.newConstParameter(200)，设置成满200元就减钱    
		//如果enableMultiple设置为true,就每满200元减x元，否则只减一次
		
		$decreaseMoneyDef = new ActionDef(102); //com.taobao.ump.meta.action.decreaseMoney
		$decreaseMoneyMetaDate = $builder->bind($decreaseMoneyDef,array($builder->newUndefineParameter('money')));
		$builder->bindTradeStatus($decreaseMoneyMetaDate, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($amountOverMetaData, $decreaseMoneyMetaDate);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson); 
	}
	
	//限购
	public function conditionLimitCheck(){
		$builder = new MarketingBuilder();
		
		//如果某个买家购买该物品超过100件，就包邮
		$limitCheckDef = new ConditionDef(117); //com.taobao.ump.meta.condition.limitCheck
		$limitCheckMetaData = $builder->bind($limitCheckDef,array($builder->newLongParameter(100)));
		
		$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($limitCheckMetaData, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//渠道效验
	public function targetChannel(){
		$builder = new MarketingBuilder();
		
		$tool = $builder->loadTool($toolJson);
		//TODO 此处需要参考前者的代码来设置相应的优惠。
		
		$activity = $builder->createActivity($tool);
		
		$channelDef = new TargetDef(206405); //com.taobao.ump.meta.target.channel
		$channelMeta = $builder->bind($channelDef,array($builder->newStringParameter('天猫')));
		//拿到渠道的积木块 ,并指定只有来自商城的买家可以享受优惠
		
		$activity->setTarget($channelMeta);
		print_r($activity);
	}
	
	//包邮
	public function actionFreePostage(){
		$builder = new MarketingBuilder();
		
		//满X件
		$itemCountOverDef = new ConditionDef(116); //com.taobao.ump.meta.condition.itemCountOver
		$itemCountOverMetaData = $builder->bind($itemCountOverDef,array($builder->newUndefineParameter('count'),$builder->newUndefineParameter('enableMultiple')));
		//这里的count和enableMultiple是指需要卖家参加活动时需要指定的参数信息
    	//当然可以也通过builder.newConstParameter(10)，设置成满10件就打折
    	
    	//包邮
    	$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($itemCountOverMetaData, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//减钱
	public function actionDecreaseMoney(){
		$builder = new MarketingBuilder();
		
		//通过资源型营销积木块取得订单金额
		$orderPriceDef = new ResourceDef(127); //com.taobao.ump.meta.resource.getOrderPriceResource
		$orderPriceMetaData = $builder->bind($orderPriceDef, array($builder->newBooleanParameter(true)));
		
		//满X元
		$amountOverDef = new ConditionDef(113); //com.taobao.ump.meta.condition.amountOver
		$amountOverMetaData = $builder->bind($amountOverDef,array($builder->newResourceParameter($orderPriceMetaData),$builder->newUndefineParameter('totalPrice'),$builder->newUndefineParameter('enableMultiple')));
		//这里的totalPrice和enableMultiple是指需要卖家参加活动时需要指定的参数信息   
		//当然可以也通过builder.newConstParameter(200)，设置成满200元就减钱    
		//如果enableMultiple设置为true,就每满200元减x元，否则只减一次
		
		$decreaseMoneyDef = new ActionDef(102); //com.taobao.ump.meta.action.decreaseMoney
		$decreaseMoneyMetaDate = $builder->bind($decreaseMoneyDef,array($builder->newUndefineParameter('money')));
		$builder->bindTradeStatus($decreaseMoneyMetaDate, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($amountOverMetaData, $decreaseMoneyMetaDate);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson); 
	}
	
	//打折
	public function actionDiscount(){
		$builder = new MarketingBuilder();
		
		//通过资源型营销积木块取得订单金额
		$orderPriceDef = new ResourceDef(127); //com.taobao.ump.meta.resource.getOrderPriceResource
		$orderPriceMetaData = $builder->bind($orderPriceDef, array($builder->newBooleanParameter(true)));
		
		//满X元
		$amountOverDef = new ConditionDef(113); //com.taobao.ump.meta.condition.amountOver
		$amountOverMetaData = $builder->bind($amountOverDef,array($builder->newResourceParameter($orderPriceMetaData),$builder->newUndefineParameter('totalPrice'),$builder->newBooleanParameter(false)));
		//这里的totalPrice是指需要卖家参加活动时需要指定的参数信息
        //当然可以也通过builder.newConstParameter(200)，设置成满200元就打折
        //打折是没有不封顶的这种情况
        
        //打折
        $discountDef = new ActionDef(103); //com.taobao.ump.meta.action.discount
        $discountMetaData = $builder->bind($discountDef,array($builder->newLongParameter(800),$builder->newResourceParameter($orderPriceMetaData)));
        //这里的800是指8折
        //$orderPriceMetaData是指要打折的计算价格
        $builder->bindTradeStatus($discountMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($amountOverMetaData, $discountMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//送积分
	public function actionSendPoint(){
		$builder = new MarketingBuilder();
		
		$sendPointDef = new ActionDef(111); //com.taobao.ump.meta.action.sendPoint
		$sendPointMetaData = $builder->bind($sendPointDef,array($builder->newStringParameter('就是要送积分'),$builder->newLongParameter(800)));
		//送800个积分
		
		$builder->bindTradeStatus($sendPointMetaData, MetaDef::TRADE_STATUS_TRADE_FINISH);
		//生成订单后进行赠送积分
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($sendPointMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//送礼物
	public function actionSendGift(){
		$builder = new MarketingBuilder();
		
		$sendGiftDef = new ActionDef(110); //com.taobao.ump.meta.action.sendGift
		$sendGiftMetaData = $builder->bind($sendGiftDef,array($builder->newStringParameter('大熊猫'),$builder->newLongParameter(123421242),$builder->newStringParameter('http://sendGift.....')));
		//送大熊猫这个礼物
		$builder->bindTradeStatus($sendGiftMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($sendGiftMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//减价倍数计算
	public function actionCalcDecrMultiple(){
		$builder = new MarketingBuilder();
		
		//根据件数设置减价的倍数，用于每件都减价的场
		$calcDecrMultipleDef = new ActionDef(133); //com.taobao.ump.meta.action.calcMultiple
		$calcDecrMultipleMetaData = $builder->bind($calcDecrMultipleDef);
		
		//减X元
		$decreaseMoneyDef = new ActionDef(102); //com.taobao.ump.meta.action.decreaseMoney
		$decreaseMoneyMetaDate = $builder->bind($decreaseMoneyDef,array($builder->newUndefineParameter('money')));
		$builder->bindTradeStatus($decreaseMoneyMetaDate, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		//这里的money是指需要卖家参加活动时需要指定的参数信息
		
		$promotionMetaData = $calcDecrMultipleMetaData->logicAnd($decreaseMoneyMetaDate);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//获取买家已购数
	public function resourceGetBuyerAccumulatePurchasedCount(){
		$builder = new MarketingBuilder();
		
		//通过资源型营销积木块取得买家已经购买该促销商品的数量
		$purchasedCountDef = new ResourceDef(124); //com.taobao.ump.meta.resource.getBuyerAccumulatePurchasedCount
		$purchasedCountMetaData = $builder->bind($purchasedCountDef);
		
		//大于多少
		$greaterDef = new ConditionDef(134); //com.taobao.ump.meta.condition.greater
		$greaterMetaData = $builder->bind($greaterDef,array($builder->newResourceParameter($purchasedCountMetaData),$builder->newLongParameter(100)));
		
		//如果某个买家购买该物品超过100件，就包邮
		$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($greaterMetaData, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//获得当前订单价格
	public function resourceGetOrderPriceResource(){
		$builder = new MarketingBuilder();
		
		//通过资源型营销积木块取得订单金额
		$orderPriceDef = new ResourceDef(127); //com.taobao.ump.meta.resource.getOrderPriceResource
		$orderPriceMetaData = $builder->bind($orderPriceDef, array($builder->newBooleanParameter(true)));
		
		//满X元
		$amountOverDef = new ConditionDef(113); //com.taobao.ump.meta.condition.amountOver
		$amountOverMetaData = $builder->bind($amountOverDef,array($builder->newResourceParameter($orderPriceMetaData),$builder->newUndefineParameter('totalPrice'),$builder->newUndefineParameter('enableMultiple')));
		//这里的totalPrice和enableMultiple是指需要卖家参加活动时需要指定的参数信息   
		//当然可以也通过builder.newConstParameter(200)，设置成满200元就减钱    
		//如果enableMultiple设置为true,就每满200元减x元，否则只减一次
		
		$decreaseMoneyDef = new ActionDef(102); //com.taobao.ump.meta.action.decreaseMoney
		$decreaseMoneyMetaDate = $builder->bind($decreaseMoneyDef,array($builder->newUndefineParameter('money')));
		$builder->bindTradeStatus($decreaseMoneyMetaDate, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($amountOverMetaData, $decreaseMoneyMetaDate);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//获取买家当前淘金币数（未开放）
	public function resourceGetCoinResource(){
		$builder = new MarketingBuilder();
		
		//通过淘金币积木块取得买家的金币数量
		$coinCountDef = new ResourceDef(171603); //com.taobao.ump.meta.resource.getCoinResource
		$coinCountMetaDate = $builder->bind($coinCountDef);
		
		//如果买家淘金币数大于50就包邮
		$greaterDef = new ConditionDef(134); //com.taobao.ump.meta.condition.greater
		$greaterMetaData = $builder->bind($greaterDef,array($builder->newResourceParameter($coinCountMetaDate),$builder->newLongParameter(50)));
		
		//包邮
		$freePostageDef = new ActionDef(104); //com.taobao.ump.meta.action.freePostage  免邮
		$freePostageMetaData = $builder->bind($freePostageDef);
		$builder->bindTradeStatus($freePostageMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($greaterMetaData, $freePostageMetaData);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//淘宝标签
	public function targetUserTag(){
		$builder = new MarketingBuilder();
		
		$tool = $builder->loadTool($toolJson);
		//TODO 此处需要参考前者的代码来设置相应的优惠。
		
		$activity = $builder->createActivity($tool);
		
		$targetDef = new TargetDef(129); //com.taobao.ump.meta.target.userTag
		$targetMeta = $builder->bind($targetDef, array($builder->newStringParameter('9999')));
		//拿到标签范围的积木块 ,并指定具有9999号标签的买家可以享受优惠
		
		$activity->setTarget($targetMeta);
		print_r($activity);
	}
	
	//店铺内客户分组
	public function targetGroupingTarget(){
		$builder = new MarketingBuilder();
		
		$tool = $builder->loadTool($toolJson);
		//TODO 此处需要参考前者的代码来设置相应的优惠。
		
		$activity = $builder->createActivity($tool);
		
		$groupingTargetDef = new TargetDef(131); //com.taobao.ump.meta.target.groupingTarget
		$groupingTargetMeta = $builder->bind($groupingTargetDef,array($builder->newStringParameter('9999')));
		//拿到标签范围的积木块 ,并指定具有9999号标签的买家可以享受优惠
		
		$activity->setTarget($groupingTargetMeta);
		print_r($activity);
	}
	
	//店铺优惠券检查
	public function conditionShopCoupon(){
		$builder = new MarketingBuilder();
		
		$shopCouponDef = new ConditionDef(118); //com.taobao.ump.meta.condition.shopCoupon
		$shopCouponMeta = $builder->bind($shopCouponDef,array($builder->newLongParameter(1234567)));
		//如果拥有编号为1234567的优惠券
		
		$decreaseMoneyDef = new ActionDef(102); //com.taobao.ump.meta.action.decreaseMoney
		$decreaseMoneyMetaDate = $builder->bind($decreaseMoneyDef,array($builder->newUndefineParameter('money')));
		$builder->bindTradeStatus($decreaseMoneyMetaDate, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$promotionMetaData = $builder->bindAction($shopCouponMeta, $decreaseMoneyMetaDate);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//送优惠券
	public function actionSendCoupon(){
		$builder = new MarketingBuilder();
		
		$sendCouponDef = new ActionDef(109); //com.taobao.ump.meta.action.sendCoupon
		$sendCouponMeta = $builder->bind($sendCouponDef,array($builder->newLongParameter(123456)));
		//送编号为123456的这个优惠券
		
		$builder->bindTradeStatus($sendCouponMeta,MetaDef::TRADE_STATUS_TRADE_FINISH);
		//生成订单后进行赠送优惠券
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($sendCouponMeta);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//冻结优惠券
	public function actionFreezeCoupon(){
		$builder = new MarketingBuilder();
		
		//通过资源型营销积木块取得订单金额
		$orderPriceDef = new ResourceDef(127); //com.taobao.ump.meta.resource.getOrderPriceResource
		$orderPriceMetaData = $builder->bind($orderPriceDef, array($builder->newBooleanParameter(true)));
		
		//满X元
		$amountOverDef = new ConditionDef(113); //com.taobao.ump.meta.condition.amountOver
		$amountOverMetaData = $builder->bind($amountOverDef,array($builder->newResourceParameter($orderPriceMetaData),$builder->newUndefineParameter('totalPrice'),$builder->newBooleanParameter(false)));
		//这里的totalPrice是指需要卖家参加活动时需要指定的参数信息
        //当然可以也通过builder.newConstParameter(200)，设置成满200元就打折
        //打折是没有不封顶的这种情况
        
        //打折
        $discountDef = new ActionDef(103); //com.taobao.ump.meta.action.discount
        $discountMetaData = $builder->bind($discountDef,array($builder->newLongParameter(800),$builder->newResourceParameter($orderPriceMetaData)));
        //这里的800是指8折
        //$orderPriceMetaData是指要打折的计算价格
        $builder->bindTradeStatus($discountMetaData, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
        
        //冻结优惠券
        $freezeCouponDef = new ActionDef(105); //com.taobao.ump.meta.action.freezeCoupon
        $freezeCouponMeta = $builder->bind($freezeCouponDef);
        $builder->bindTradeStatus($freezeCouponMeta, MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
        
        $promotionMetaData = $builder->bindAction($amountOverMetaData, $discountMetaData);
        $promotionMetaData = $promotionMetaData->logicAnd($freezeCouponMeta);
        
        $tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//注销优惠券
	public function actionLogoutCoupon(){
		$builder = new MarketingBuilder();
		
		$logoutCouponDef = new ActionDef(106); //com.taobao.ump.meta.action.logoutCoupon
		$logoutCouponMeta = $builder->bind($logoutCouponDef);
		$builder->bindTradeStatus($logoutCouponMeta,MetaDef::TRADE_STATUS_TRADE_FINISH);
		//关闭优惠券
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($logoutCouponMeta);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	} 
	
	//退回优惠券
	public function actionReturnCoupon(){
		$builder = new MarketingBuilder();
		
		$tradeCloseStatusDef = new ConditionDef(122); //com.taobao.ump.meta.condition.tradeCloseStatus
		$tradeCloseStatusMeta = $builder->bind($tradeCloseStatusDef);
		//如果交易关闭了，就退回优惠券
		
		$returnCouponDef = new ActionDef(108); //com.taobao.ump.meta.action.returnCoupon
		$returnCouponMeta = $builder->bind($returnCouponDef);
		//退回优惠券
		
		$promotionMetaData = $builder->bindAction($tradeCloseStatusMeta, $returnCouponMeta);
        
        $tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//添加用户标签
	public function actionAddUserTag(){
		$builder = new MarketingBuilder();
		
		$tradeAfterCreateOrderStatusDef = new ConditionDef(120); //com.taobao.ump.meta.condition.tradeAfterCreateOrderStatus
		$tradeAfterCreateOrderStatusMeta = $builder->bind($tradeAfterCreateOrderStatusDef);
		//生成订单后进行赠送积分
		
		$addUserTagDef = new ActionDef(101); //com.taobao.ump.meta.action.addUserTag
		$addUserTagMeta = $builder->bind($addUserTagDef,array($builder->newStringParameter('800')));
		//生成订单后为买家打上ID为800的标签
		
		$promotionMetaData = $builder->bindAction($tradeAfterCreateOrderStatusMeta, $addUserTagMeta);
        
        $tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//删除用户标签
	public function actionRemoveUserTag(){
		$builder = new MarketingBuilder();
		
		$tradeAfterCreateOrderStatusDef = new ConditionDef(120); //com.taobao.ump.meta.condition.tradeAfterCreateOrderStatus
		$tradeAfterCreateOrderStatusMeta = $builder->bind($tradeAfterCreateOrderStatusDef);
		//生成订单后进行赠送积分
		
		$removeUserTagDef = new ActionDef(107); //com.taobao.ump.meta.action.removeUserTag
		$removeUserTagMeta = $builder->bind($removeUserTagDef,array($builder->newStringParameter('800')));
		//生成订单后去掉ID为800的标签
		
		$promotionMetaData = $builder->bindAction($tradeAfterCreateOrderStatusMeta, $removeUserTagMeta);
        
        $tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($promotionMetaData);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//消耗淘金币
	public function actionConsumeCoin(){
		$builder = new MarketingBuilder();
		
		$consumeCoinDef = new ActionDef(159102); //com.taobao.ump.meta.action.consumeCoin
		$consumeCoinMeta = $builder->bind($consumeCoinDef,array($builder->newLongParameter(800)));
		//扣除800淘金币
		$builder->bindTradeStatus($consumeCoinMeta,MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER);
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($consumeCoinMeta);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
	
	//送淘金币
	public function actionAddCoin(){
		$builder = new MarketingBuilder();
		
		$addCoinDef = new ActionDef(159101); //com.taobao.ump.meta.action.addCoin
		$addCoinMeta = $builder->bind($addCoinDef,array($builder->newLongParameter(800)));
		//送800淘金币
		$builder->bindTradeStatus($addCoinMeta,MetaDef::TRADE_STATUS_TRADE_FINISH);
		//生成订单后进行赠送金币
		
		$tool = new MarketingTool();
		$tool->setName('phpmbb');
		$tool->setDescription('phpmbb');
		$tool->setToolCode('ziniuphpmbb' . time());
		$tool->setType(MarketingTool::TOOL_TYPE_SUB_ORDER);
		$tool->setOperationMeta($addCoinMeta);
		$toolJson = $builder->buildTool($tool);
		print_r($toolJson);
	}
 }
?>
