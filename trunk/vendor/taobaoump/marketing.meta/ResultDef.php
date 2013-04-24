<?php

/**
 * Resource型元数据的返回值定义
 * @author taobao 2011-4-22 下午03:16:03
 */
class ResultDef extends ParameterDef {
	
	function ResultDef($valueType, $className){
		$this->ParameterDef('RETURN', $valueType, $className);
	}
}

?>