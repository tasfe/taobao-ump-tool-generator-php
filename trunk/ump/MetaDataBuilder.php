<?php
class MetaDataBuilder{
	private $undefinedVariables;
	private $resourceMetaDatas;
	private $actions;
	/**
	 * @var MarketingBuilder
	 */
	private $builder;
	public function __construct(array $actions,MarketingBuilder $builder){
		$this->actions=$actions;
		$this->builder=$builder;
	}
	
	public function createMetaData(){
		if (isset($this->actions['RESOURCE'])) $this->createResourcesMetaData($this->actions['RESOURCE']);//复用RESOURCE
		$metaData=$this->createActionMetaData($this->actions);
		return $metaData;
	}
	
	private function createResourcesMetaData($config){
		foreach ($config as $k=>$c){
			$this->resourceMetaDatas[$k]=$this->createSimpleMetaData('resource', $c);
		}
	}
	
	/**
	 * @param string $type one of 'action','resource','condition'
	 * @param array $config configuration of the metaData of $type
	 * @return MetaData
	 */
	private function createSimpleMetaData($type,array $config){
		$config=CommonHelper::sureDefined($config, array('params'=>array()));
		$metaDef=$this->fetchMbbDefByCode($type, $config['code']);
		$paramsDefs=$this->createParamsDefs($config['params']);
		$metaData=$this->builder->bind($metaDef,$paramsDefs);
		if ($type=='action'&&isset($config['STATUS'])){//只有action 才绑定status
			$metaDataAction=$this->bindTradeStatus($metaData,$config['STATUS']);
		}
		return $metaData;
	}
	
	/**
	 * Action 一共三种情况 直接action，用and并列连接顺序执行的action，condition与action复合组成的
	 * @param array $config
	 * @return MetaData
	 */
	private function createActionMetaData(array $config){
		if (isset($config['code'])){
			$metaDataAction=$this->createSimpleMetaData('action',$config);
		}elseif (isset($config['ACTION'])){
			$metaDataAction=$this->createActionCompositeMetaData($config);
		}else{
			$metaDataAction=$this->createActionAndMetaData($config);
		}
		return $metaDataAction;
	}
	
	/**
	 * 处理用AND连接的action
	 * @param array $config
	 * @throws UmpException
	 * @return MetaData
	 */
	private function createActionAndMetaData($config){
		$metaData=null;
		foreach ($config as $k=>$configAction){
			if (!is_numeric($k)){
				throw new UmpException("key is associtive:$k ".print_r($configAction,true));
			}
			$metaDataAction=$this->createActionMetaData($configAction);
			if ($metaData===null){
				$metaData=$metaDataAction;
			}else{
				$metaData=$metaData->logicAnd($metaDataAction);
			}
		}
		return $metaData;
	}
	
	/**
	 * 一般带有condition的复合action
	 * @param array $config
	 * @return MetaData
	 */
	private function createActionCompositeMetaData($config){
		$metaDataAction=$this->createActionMetaData($config['ACTION']);
		if (isset($config['CONDITION'])){
			$metaDataCondition=$this->createConditionMetaData($config['CONDITION']);
			$metaDataAction=$this->builder->bindAction($metaDataCondition, $metaDataAction);
		}
		return $metaDataAction;
	}
	

	/**
	 * Conditional MetaData一共有两种情况，简单的condition和带有AND OR 及NOT的condition
	 * @param array $config
	 * @return ConditionalMetaData
	 */
	private function createConditionMetaData($config){
		if (isset($config['code'])){
			$metaData=$this->createSimpleMetaData('condition',$config);
		}else{
			$metaData=$this->createConditionCompositeMetaData($config);
		}
		return $metaData;
	}
	
	/**
	 * @param array $config
	 * @throws ConditionalMetaData
	 */
	private function createConditionCompositeMetaData($config){
		foreach ($config as $k=>$c){
			$metaData=null;
			$metaDataCondition=$this->createConditionMetaData($c);
			switch($k){
			    case 'AND':
			    	if ($metaData!=null){
			    		$metaData=$metaData->logicAnd($metaDataCondition);
			    	}
			    	break;
			    case 'OR':
			    	if ($metaData!=null){
			    		$metaData=$metaData->logicOR($metaDataCondition);
			    	}
			    	break;
			    case 'NOT':
			    	$metaData=$metaData->logicNot();
			    default:if ($k!==0){throw new UmpException('miss logical operation');};
	
			}
			if ($metaData===null){
				$metaData=$metaDataCondition;
			}
		}
	}
	
	
	/**
	 * UNDEFINE 为之后MarketingDetail中上传指定的
	 * RESOURCE 在开始时定义
	 * 其余按照PHP的type新建
	 * @param array $params
	 * @return ParameterValue
	 */
	private function createParamsDefs($params){
		$paramsDefs=null;
		foreach ($params as $k=>$t){
			if ($t==='UNDEFINE') {
				$paramDef=$this->builder->newUndefineParameter($k);
				$this->undefinedVariables[]=$k;
			}elseif($t==='RESOURCE'){
				$paramDef=$this->builder->newResourceParameter($this->resourceMetaDatas[$k]);
			}else{
				$method='new'.ucfirst($this->getPHPType($t)).'Parameter';
				$paramDef=$this->builder->$method($t);
			}
			$paramsDefs[]=$paramDef;
		}
		return $paramsDefs;
	}
	
	private function getPHPType($str){
		$type=gettype($str);
		if ($type=='integer') return 'long';
		return $type;
	}

	/**
	 * 加上 Status 条件
	 * @throws UmpException
	 * @return MetaData
	 */
	private function bindTradeStatus(MetaData $metaDataAction,$status){
		switch ($status){
		    case 'BEFORE':
		    	$statusCode=MetaDef::TRADE_STATUS_BEFORE_CREATE_ORDER;
		    	break;
		    case 'AFTER':
		    	$statusCode=MetaDef::TRADE_STATUS_AFTER_CREATE_ORDER;
		    	break;
		    case 'CLOSE':
		    	$statusCode=MetaDef::TRADE_STATUS_TRADE_CLOSE;
		    	break;
		    case 'FINISH':
		    	$statusCode=MetaDef::TRADE_STATUS_TRADE_FINISH;
		    	break;
		    default:throw new UmpException('status not in list');
		}
		$this->builder->bindTradeStatus($metaDataAction, $statusCode);
		return $metaDataAction;
	}
	
	private function fetchMbbDefByCode($type,$code){
		if (!in_array($type, array('action','resource','condition'))){
			throw new UmpException('Type not in list');
		}
		$c='com.taobao.ump.meta.'.$type.'.'.$code;
		$id=Ump2ToolUtil::findMbbIdByCode($c);
		$class=new ReflectionClass(ucfirst($type).'Def');
		return $class->newInstanceArgs(array($id));
	}
	
}

?>