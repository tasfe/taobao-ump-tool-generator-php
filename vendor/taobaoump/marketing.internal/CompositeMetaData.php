<?php
include_once '../../marketing.meta/MetaData.php';
/**
 * 复合类型的元数据
 * @author taobao 2011-4-22 下午05:57:04
 */
abstract class CompositeMetaData extends MetaData {
	
	public abstract function getElements();
}

?>