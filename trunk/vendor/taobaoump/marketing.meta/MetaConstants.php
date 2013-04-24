<?php
/**
 * 与元数据相关的常量
 * @author taobao 2011-4-22 下午03:35:08
 */
class MetaConstants {
	
	const TOOL_SCHEMA = '1.0.0';
	const ACTIVITY_SCHEMA = '1.0.0';
	const DETAIL_SCHEMA = '1.0.0';
	const META_SCHEMA = '1.0.0';
	
	/**
	 * 元数据FeatureKey
	 * 范围型元数据
	 */
	const FEATURE_KEY_RANGE_TYPE = "RANGE_TYPE";
	
	/**
	 * 元数据FeatureKey 
	 * 资源型元数据
	 */
	const FEATURE_KEY_RSC_PARAM = "RSC_PARAM";
	
	/**
	 * 元数据类型
	 */
	const META_TYPE_RESOURCE = 0;
	const META_TYPE_TERM = 1;
	const META_TYPE_OPERATION = 2;
	const META_TYPE_CONDITION = 3;
	const META_TYPE_ACTION = 4;
	const META_TYPE_TERM_TARGET = 5;
	const META_TYPE_TERM_RANGE = 6;
	
	/**
	 * 资源型元数据 返回值
	 */
	const CONTEXT_KEY_RESOURCE_RETURN = "com_taobao_ump_param_inner_return_key";
	
	/**
	 * 优惠次数
	 */
	const UMP_PARAM_MULTI_TIME = "com_taobao_param_multi_time";
	
	/**
	 * 元数据定义Status字段
	 * 1 : 正常
	 */
	const DEF_STATUS_NORMAL = 1;
	
	/**
	 * 元数据定义Status字段
	 * -1 : 已删除
	 */
	const DEF_STATUS_DELETED = - 1;
	
	/*
     *  修改元数据访问权限和元数据提供者类型要注意
     *  这2者的值与权限处理的方法密切关联 不可随意修改 
     */
	/**
	 * 元数据提供者类型 内部
	 */
	const PROVIDER_TYPE_UMP = 2;
	/**
	 * 元数据提供者类型 TAOBAO
	 */
	const PROVIDER_TYPE_TAOBAO = 1;
	/**
	 * 元数据提供者类型 ISV
	 */
	const PROVIDER_TYPE_ISV = 0;
	
	/*
     *  修改元数据访问权限和元数据提供者类型要注意
     *  这2者的值与权限处理的方法密切关联 不可随意修改 
     */
	/**
	 * 元数据访问权限
	 * 0 : 所有人均可访问
	 */
	const PRIVILEGE_ALL = 0;
	
	/**
	 * 元数据访问权限
	 * 1 : 仅淘宝内部可以访问
	 */
	const PRIVILEGE_TAOBAO = 1;
	
	/**
	 * 元数据访问权限
	 * 2 : 仅UMP可以访问
	 */
	const PRIVILEGE_UMP = 2;
	
	/**
	 * 元数据访问权限
	 * 3 : 不可通过查询方法访问，只能通过metaId或Id访问
	 */
	const PRIVILEGE_PRIVATE = 3;
	
	/**
	 * 参数可接受的业务类型
	 * 0: 全部可接受
	 */
	const PARAM_LOGIC_TYPE_ALL = 0;
	
	/**
	 * 参数可接受的业务类型
	 * 1: 商品id
	 */
	const PARAM_LOGIC_TYPE_ITEMID = 1;
	/**
	 * 参数可接受的业务类型
	 * 2: 店铺id
	 */
	const PARAM_LOGIC_TYPE_SHOPID = 2;
	/**
	 * 参数可接受的业务类型
	 * 3: sellerId
	 */
	const PARAM_LOGIC_TYPE_SELLERID = 3;
	/**
	 * 参数可接受的业务类型
	 * 4: skuId
	 */
	const PARAM_LOGIC_TYPE_SKUID = 4;
	/**
	 * 参数可接受的业务类型
	 * 5: categoryId
	 */
	const PARAM_LOGIC_TYPE_CATEGORYID = 5;
	/**
	 * 参数可接受的业务类型
	 * 6: shopCategoryId
	 */
	const PARAM_LOGIC_TYPE_SHOPCATEGORYID = 6;
	
	/**
	 * 元数据、参数正常状态
	 * 1：正常状态
	 */
	const STATUS_NORMOL = 1;
	
	/**
	 * 元数据、参数删除状态
	 * -1：删除状态
	 */
	const STATUS_DELETE = - 1;
	
	/**
	 * 元数据逻辑状态正常
	 * 1：申请中， 可删除，不可查询，不可使用
	 */
	const LOGIC_STATUS_APPLY = 1;
	
	/**
	 * 元数据逻辑状态正常
	 * 2：冻结状态，可通过检查使用数后删除，不可查询，可使用
	 */
	const LOGIC_STATUS_FREEZE = 2;
	
	/**
	 * 元数据逻辑状态正常
	 * 3: 正在使用中，不可删除，可查询，可使用
	 */
	const LOGIC_STATUS_WORKING = 3;
	
	/**
	 * 元数据安全级别 
	 * 5：UMP内部默认级别
	 */
	const SECURITY_LEVEL_UMP = 5;
	
	/**
	 * 元数据安全级别
	 * 4：TAOBAO内部默认级别
	 */
	const SECURITY_LEVEL_TAOBAO = 4;
	
	/**
	 * 元数据安全级别
	 * 3：ISV最高级别
	 */
	const SECURITY_LEVEL_THIRD = 3;
	
	/**
	 * 元数据安全级别
	 * 2： ISV较高级别
	 */
	const SECURITY_LEVEL_SECOND = 2;
	
	/**
	 * 元数据安全级别
	 * 1： ISV普通级别
	 */
	const SECURITY_LEVEL_FIRST = 1;
	
	/**
	 * 最大元数据缓存数
	 */
	const MAX_ELEMENT_IN_MEMORY = 10000;

}

?>