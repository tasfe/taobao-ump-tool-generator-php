<?php
include_once '../../marketing.meta/MetaDef.php';

/**
 * 优惠域的元数据定义
 * 由特定不同类型的优惠域元数据组成。
 * @author taobao 2011-4-22 下午07:09:51
 */
class TermDef extends MetaDef {
	
	public function TermDef($id, $parameters = array(), $desc = null){
		$this->MetaDef($id, $parameters, $desc);
	}
}

?>