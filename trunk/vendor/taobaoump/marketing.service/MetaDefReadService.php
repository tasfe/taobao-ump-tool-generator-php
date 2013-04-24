<?php
/**
 * 用于读取元数据定义的接口
 * @author taobao
 */
interface MetaDefReadService extends MetaDefProvider {
	
	/**
	 * 获取所有有权限访问的元数据列表
	 * @param $providerInfo 访问者信息
	 * @return array
	 */
	public function getAllMetaDef(ProviderInfo $providerInfo);
	
	/**
	 * 根据id获取指定元数据定义
	 * 该方法不做权限控制
	 * @param $metaId
	 * @return MetaDef
	 */
	public function getMetaDefByMetaId($metaId);
	
	/**
	 * 根据类型获取有权限访问的元数据列表
	 * @param $typeId
	 * @param $providerInfo 访问者信息
	 * @see ProviderInfo
	 * @return array
	 */
	public function getMetaDefListByType($typeId, ProviderInfo $providerInfo);
	
	/**
	 * 检查元数据执行器的标示是否可用
	 * @param $metaId
	 * @return boolean MetaId是否可用
	 */
	public function checkMetaIdAvailable($metaId);

}

?>