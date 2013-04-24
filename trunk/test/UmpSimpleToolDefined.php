<?php
class UmpSimpleToolDefined{

	public static function getTestToolActions0(){
		$actions=array('STATUS'=>'BEFORE',
					'ACTION'=>array('code'=>'decreaseMoney','params'=>array('decreaseMoney'=>'UNDEFINE')));
		return $actions;
	}

	public static function getTestToolActions1(){
		$actions=array(
					'RESOURCE'=>array(
									'PriceResource'=>array('code'=>'getOrderPriceResource',
														'params'=>array('discount'=>true))),
					'CONDITION'=>array('code'=>'amountOver',
									'params'=>array('PriceResource'=>'RESOURCE','amountAt'=>'UNDEFINE',
													'enableMultiple'=>'UNDEFINE')),
					'ACTION'=>array(
									array(
										'ACTION'=>array('code'=>'decreaseMoney',
														'params'=>array('decreaseMoney'=>'UNDEFINE'))),
									array(
										'CONDITION'=>array('code'=>'excludeArea',
														'params'=>array('excludeArea'=>'UNDEFINE')),
										
										'ACTION'=>array('code'=>'freePostage')),
									));
		return $actions;
	}

	public static function getTestToolActions2(){
		$actions=array(
					'RESOURCE'=>array(
									'PriceResource'=>array('code'=>'getOrderPriceResource',
														'params'=>array('discount'=>true))),
					'CONDITION'=>array('code'=>'amountOver',
									'params'=>array('PriceResource'=>'RESOURCE','amountAt'=>'UNDEFINE',
													'enableMultiple'=>'UNDEFINE')),
					'ACTION'=>array(
									array(
										'ACTION'=>array('code'=>'discount',
														'params'=>array('discountRate'=>'UNDEFINE',
																		'PriceResource'=>'RESOURCE'))),
									array(
										'CONDITION'=>array('code'=>'excludeArea',
														'params'=>array('excludeArea'=>'UNDEFINE')),
										'ACTION'=>array('code'=>'freePostage')),
									));
		return $actions;
	}

	public static function getTestToolActions3(){
		$actions=array(
					'CONDITION'=>array('code'=>'itemCountOver',
									'params'=>array('itemCount'=>'UNDEFINE','enableMultiple'=>'UNDEFINE')),
					'ACTION'=>array(
									array(
										'ACTION'=>array('code'=>'decreaseMoney',
														'params'=>array('decreaseMoney'=>'UNDEFINE'))),
									array(
										'CONDITION'=>array('code'=>'excludeArea',
														'params'=>array('excludeArea'=>'UNDEFINE')),
										'ACTION'=>array('code'=>'freePostage')),
									));
		return $actions;
	}

	public static function getTestToolActions4(){
		$actions=array(
					'RESOURCE'=>array(
									'PriceResource'=>array('code'=>'getOrderPriceResource',
														'params'=>array('discount'=>true))),
					'CONDITION'=>array('code'=>'itemCountOver',
									'params'=>array('itemCount'=>'UNDEFINE','enableMultiple'=>'UNDEFINE')),
					'ACTION'=>array(
									array(
										'ACTION'=>array('code'=>'discount',
														'params'=>array('discountRate'=>'UNDEFINE',
																		'PriceResource'=>'RESOURCE'))),
									array(
										'CONDITION'=>array('code'=>'excludeArea',
														'params'=>array('excludeArea'=>'UNDEFINE')),
										'ACTION'=>array('code'=>'freePostage')),
									));
		return $actions;
	}
}

?>