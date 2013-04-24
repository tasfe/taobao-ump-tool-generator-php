<?php

include_once '../../marketing.meta/MetaDef.php';

/**
 * 行为的元数据定义
 * 逻辑上有行为元数据和条件元数据组成
 * @author taobao 2011-4-22 下午07:09:51
 */
class OperationDef extends MetaDef {
	
	public function OperationDef($id, $parameters = array(), $desc = null){
		$this->MetaDef($id, $parameters, $desc);
	}
}

?>