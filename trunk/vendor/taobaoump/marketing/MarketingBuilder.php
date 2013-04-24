<?php

include_once '../../marketing/MarketingActivity.php';
include_once '../../marketing/MarketingDetail.php';
include_once '../../marketing/MarketingTool.php';
include_once '../../marketing/ParameterValue.php';
include_once '../../marketing.meta/ParameterDef.php';
include_once '../../marketing.internal/DualMetaData.php';
include_once '../../marketing.internal/LogicAndMetaData.php';
include_once '../../marketing.internal/LogicNotMetaData.php';
include_once '../../marketing.internal/LogicOrMetaData.php';
include_once '../../marketing.internal/ConditionalMetaData.php';
include_once '../../marketing.internal/MarketingActivityHandler.php';
include_once '../../marketing.internal/MarketingDetailHandler.php';
include_once '../../marketing.internal/MarketingToolHandler.php';

/**
 * 营销工具构建器
 * @author taobao 2011-4-22 下午02:18:04
 */
class MarketingBuilder {
	
	private $metaDefProvider;
	
	/**
	 * 生成工具预定义的参数值，工具实例化不能覆盖这些参数
	 * @param $value
	 * @param $isArray
	 * @return ParameterValue
	 */
	public function newBooleanParameter($value, $isArray = false){
		$paramDef = new ParameterDef(null, ParameterDef::VALUE_TYPE_BOOLEAN, null, $isArray);
		return new ParameterValue(null, $paramDef, null, ParameterValue::KIND_DEFINED, $value);
	}
	
	/**
	 * 生成工具预定义的参数值，工具实例化不能覆盖这些参数
	 * @param $value
	 * @param $isArray
	 * @return ParameterValue
	 */
	public function newStringParameter($value, $isArray = false){
		$paramDef = new ParameterDef(null, ParameterDef::VALUE_TYPE_STRING, null, $isArray);
		return new ParameterValue(null, $paramDef, null, ParameterValue::KIND_DEFINED, $value);
	}
	
	/**
	 * 生成工具预定义的参数值，工具实例化不能覆盖这些参数
	 * @param $value
	 * @param $isArray
	 * @return ParameterValue
	 */
	public function newDateParameter($value, $isArray = false){
		$paramDef = new ParameterDef(null, ParameterDef::VALUE_TYPE_DATE, null, $isArray);
		return new ParameterValue(null, $paramDef, null, ParameterValue::KIND_DEFINED, $value);
	}
	
	/**
	 * 生成工具预定义的参数值，工具实例化不能覆盖这些参数
	 * @param $value
	 * @param $isArray
	 * @return ParameterValue
	 */
	public function newDoubleParameter($value, $isArray = false){
		$paramDef = new ParameterDef(null, ParameterDef::VALUE_TYPE_DOUBLE, null, $isArray);
		return new ParameterValue(null, $paramDef, null, ParameterValue::KIND_DEFINED, $value);
	}
	
	/**
	 * 生成工具预定义的参数值，工具实例化不能覆盖这些参数
	 * @param $value
	 * @param $isArray
	 * @return ParameterValue
	 */
	public function newLongParameter($value, $isArray = false){
		$paramDef = new ParameterDef(null, ParameterDef::VALUE_TYPE_LONG, null, $isArray);
		return new ParameterValue(null, $paramDef, null, ParameterValue::KIND_DEFINED, $value);
	}
	
	/**
	 * 生成工具组装时尚未定义的参数值，这些参数将留待工具实例化时填入。
	 * @param $parmaId
	 * @return ParameterValue
	 */
	public function newUndefineParameter($parmaId){
		return new ParameterValue($parmaId, null, null, ParameterValue::KIND_UNDEFINE, null);
	}
	
	/**
	 * 生成资源型参数值，需要传入资源型元数据
	 * @param $resource 资源型元数据
	 * @return ParameterValue
	 */
	public function newResourceParameter($resource){
		return new ParameterValue(null, null, null, ParameterValue::KIND_RESOURCE, $resource);
	}
	
	/**
	 * 将元数据定义与参数值绑定，形成一个元数据
	 * @param MetaDef $metaDef
	 * @param ParameterValue[] $parameterValues 可以为null
	 * @return MetaData
	 */
	public function bind(MetaDef $metaDef, $parameterValues = null){
		return new MetaData($metaDef, $parameterValues, null);
	}
	
	/**
	 * 将 Condition 元数据与 Action 元数据组装为 Operation 元数据
	 * @param $condition 待组装的 Condition 元数据
	 * @param $action 待组装的 Action 元数据
	 * @return MetaData 组装所得的 Operation 元数据
	 */
	public function bindAction(MetaData $condition, MetaData $action){
		if ( $condition == null ) {
			return $action;
		}
		return new DualMetaData($condition, $action);
	}
	
	/**
	 * 绑定了一个 boolean 参数。
	 * 运行时只有当该参数被实例化设置为true时，才会执行实际的元数据。
	 * 这个 API 的使用场景是为 $target 这个元数据再包装一个布尔判断，供实例化时填入
	 * @param MetaData $target
	 * @param $parmaId
	 */
	public function bindConditional(MetaData $target, $parmaId){
		return new ConditionalMetaData($target, $parmaId);
	}
	
	/**
	 * 将行为元数据设置为指定的交易状态，覆盖这个行为元数据下面的所有
	 * 子行为元数据的交易状态
	 *
	 * @param $action
	 * @param $tradeStatus
	 * @return
	 */
	public function bindTradeStatus(MetaData $action, $tradeStatus){
		$action->setTradeStatus($tradeStatus);
		return action;
	}
	
	/**
	 * 验证活动设置是否正确
	 * @param MarketingActivity $marketingActivity
	 * @throws MarketingException
	 */
	public function validateActivity(MarketingActivity $marketingActivity){
		//TODO 未实现
	}
	
	/**
	 * 验证活动详情是否正确
	 * @param MarketingDetail $marketingDetail
	 * @throws MarketingException
	 */
	public function validateDetail(MarketingDetail $marketingDetail){
		//TODO 未实现
	}
	
	/**
	 * 验证营销工具设置是否正确
	 * @param MarketingDetail $marketingActivity
	 * @throws MarketingException
	 */
	public function validateTool(MarketingTool $marketingTool){
		//TODO 未实现
	}
	
	/**
	 * 构建活动为 Json 字符串
	 * @param MarketingActivity $marketingActivity
	 * @return json
	 */
	public function buildActivity(MarketingActivity $marketingActivity){
		$result = MarketingActivityHandler::serialize($marketingActivity);
		$json = json_encode($result);
		return $json;
	}
	
	/**
	 * 构建活动详情为 Json 字符串
	 * @param MarketingDetail $marketingDetail
	 * @return json
	 */
	public function buildDetail(MarketingDetail $marketingDetail){
		$result = MarketingDetailHandler::serialize($marketingDetail);
		$json = json_encode($result);
		return $json;
	}
	
	/**
	 * 构建营销工具为 Json 字符串
	 * @param MarketingTool $marketingTool
	 * @return $json
	 */
	public function buildTool(MarketingTool $marketingTool){
		$result = MarketingToolHandler::serialize($marketingTool);
		$json = json_encode($result);
		return $json;
	}
	
	/**
	 * 从 Json 字符串创建活动
	 * @param $tool
	 * @param $json
	 * @return MarketingActivity
	 */
	public function loadActivity(MarketingTool $tool, $json){
		$result = json_decode($json, true);
		$activity = MarketingActivityHandler::deserialize($result);
		$activity->setTool($tool);
		$activity->initActivityParams();
		return $activity;
	}
	
	/**
	 * 从 Json 字符串创建活动详情
	 * @param $activity
	 * @param $json
	 * @return MarketingDetail
	 */
	public function loadDetail(MarketingActivity $activity, $json){
		$result = json_decode($json, true);
		$detail = MarketingDetailHandler::deserialize($result);
		$detail->setActivity($activity);
		$detail->initDetailParams();
		return $detail;
	}
	
	/**
	 * 从 Json 字符串创建营销工具
	 * @param json
	 * @return MarketingTool
	 */
	public function loadTool($json){
		$result = json_decode($json, true);
		$tool = MarketingToolHandler::deserialize($result);
		return $tool;
	}
	
	/**
	 * 从 Json 字符串创建营销积木块
	 * @param $json
	 * @return MetaDef
	 */
	public function loadMetaDef($json){
		$result = json_decode($json, true);
		$def = null;
		return $def;
	}
	
	/**
	 * 从 Json 字符串创建元数据
	 * @param jsonMetaData
	 * @return 
	 */
	public function loadMetaData($json){
		$result = json_decode($json, true);
		$metaData = MetaDataHandler::deserialize($result);
		return $metaData;
	}
	
	/**
	 * 根据工具创建一个活动
	 * @param MarketingTool $marketingTool
	 * @return MarketingActivity
	 */
	public function createActivity(MarketingTool $marketingTool){
		$activity = new MarketingActivity();
		$activity->setTool($marketingTool);
		$activity->initActivityParams();
		return $activity;
	}
	
	/**
	 * 为活动创建优惠对象的元数据
	 * @param $targetDef 对象元数据
	 * @param $values 对象元数据的可选值，中间自动绑定 or 的逻辑关系
	 * @return MetaData 创建的对象元数据
	 */
	public function createActivityTarget(TargetDef $targetDef, $values = array()){
		if ( count($targetDef->getParameters()) > 1 ) {
			throw new MarketingException('加载的对象元数据定义不正确，参数数目大于 1');
		}
		if ( count($targetDef->getParameters()) == 0 ) {
			return $this->bind($targetDef);
		}
		if ( count($values) > 1 ) {
			$elements = array();
			foreach( $values as $value ) {
				$elements[] = $this->bind($targetDef, $this->newStringParameter($value));
			}
			return new LogicOrMetaData($elements);
		} elseif ( count($values) == 1 ) {
			return $this->bind($targetDef, $this->newStringParameter($values[0]));
		} else {
			throw new MarketingException("填入的营销对象参数的数目必须大于等于 1");
		}
	}
	
	/**
	 * 根据活动创建一个详情
	 * @param MarketingActivity $marketingActivity
	 * @return MarketingDetail
	 */
	public function createDetail(MarketingActivity $marketingActivity){
		$detail = new MarketingDetail();
		$detail->setActivity($marketingActivity);
		$detail->initDetailParams();
		return $detail;
	}
	
	/**
	 * 创建一个营销工具
	 * @return MarketingTool
	 */
	public function createTool(){
		return new MarketingTool();
	}
	
	/**
	 * 注入元数据定义服务
	 * @param metaDefProvider
	 */
	public function setMetaDefProvider(MetaDefProvider $metaDefProvider){
		$this->metaDefProvider = $metaDefProvider;
	}
}

?>