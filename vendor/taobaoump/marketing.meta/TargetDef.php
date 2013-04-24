<?php
include_once '../../marketing.meta/MetaDef.php';

/**
 * 优惠对象元数据定义。
 * 是优惠域元数据的一种，用于检查优惠对象。
 * @author taobao 2011-4-22 下午07:09:51
 */
class TargetDef extends MetaDef {
	
	public function TargetDef($id, $parameters = array(), $desc = null){
		$this->MetaDef($id, $parameters, $desc);
	}
}

?>