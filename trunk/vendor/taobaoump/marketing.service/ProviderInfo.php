<?php
/**
 * 访问者信息，用于区别访问者身份与访问权限
 * @author taobao
 */
class ProviderInfo {
	
	/**
	 * providerKey 访问者标示，可为空
	 * @see MetaConstants
	 */
	private $providerKey;
	
	/**
	 * @param $providerKey ISV信息
	 */
	public function ProviderInfo($providerKey){
		$this->providerKey = $providerKey;
	}
	
	/**
	 * @return the $providerKey
	 */
	public function getProviderKey(){
		return $this->providerKey;
	}
	
	/**
	 * @param $providerKey the $providerKey to set
	 */
	public function setProviderKey($providerKey){
		$this->providerKey = $providerKey;
	}

}

?>