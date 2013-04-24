<?php
include_once '../../marketing.meta/MetaDef.php';

/**
 * 条件的元数据定义
 * @author taobao 2011-4-22 下午07:09:51
 */
class ConditionDef extends MetaDef {
	
	public function ConditionDef($id, $parameters = array(), $desc = null){
		$this->MetaDef($id, $parameters, $desc);
	}
}

?>