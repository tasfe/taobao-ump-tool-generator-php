<?php

/**
 * @author taobao 2011-4-29 下午04:33:49
 */
interface MetaDefProvider {
	
	/**
	 * 根据id获取指定元数据定义，该方法不做权限控制
	 * 建议由ISV自行实现
	 * @param $id
	 * @return MetaDef
	 */
	public function getMetaDefById($id);
}

?>