<?php

/**
 * @author taobao 2011-5-25 下午03:00:01
 */
class TaobaoQuery {
	
	private $sysParams = array(); //系统参数
	private $apiParams = array(); //API参数
	private $topAppkey;
	private $topAppSecret;
	private $topSession;
	private $topUrl;
	
	/**
	 * @param $method
	 * @param $format
	 */
	function TaobaoQuery($method, $format = 'json'){
		$this->sysParams['method'] = $method;
		$this->sysParams['format'] = $format;
		$this->topUrl = 'http://gw.api.tbsandbox.com/router/rest';
		$this->topAppkey = '1012271513';
		$this->topAppSecret = 'sandboxbd3798255b6b3a7148123e0eb';
		$this->topSession = '610212132421fa9870ece1b0d41ee1bcc53ec6e3ec8e1d72055666336';
	}
	
	/**
	 * 设置API参数
	 * @param $key
	 * @param $val
	 */
	function setParam($key, $val){
		if ( $val != null ) {
			$this->apiParams[$key] = $val;
		}
	}
	
	/**
	 * 返回API参数
	 * @param $key
	 * @param $defaultValue
	 */
	function getParam($key, $defaultValue = ""){
		if ( array_key_exists($key, $this->apiParams) ) {
			return $this->apiParams[$key];
		} else {
			return $defaultValue;
		}
	}
	
	/**
	 * @return the $sysParams
	 */
	public function getSysParams(){
		return $this->sysParams;
	}
	
	/**
	 * @return the $apiParams
	 */
	public function getApiParams(){
		return $this->apiParams;
	}
	
	/**
	 * @param $sysParams the $sysParams to set
	 */
	public function setSysParams($sysParams){
		$this->sysParams = $sysParams;
	}
	
	/**
	 * @param $apiParams the $apiParams to set
	 */
	public function setApiParams($apiParams){
		$this->apiParams = $apiParams;
	}
	/**
	 * @return the $topAppkey
	 */
	public function getTopAppkey(){
		return $this->topAppkey;
	}
	
	/**
	 * @return the $topSession
	 */
	public function getTopSession(){
		return $this->topSession;
	}
	
	/**
	 * @param $topAppkey the $topAppkey to set
	 */
	public function setTopAppkey($topAppkey){
		$this->topAppkey = $topAppkey;
	}
	
	/**
	 * @param $topSession the $topSession to set
	 */
	public function setTopSession($topSession){
		$this->topSession = $topSession;
	}
	/**
	 * @return the $topAppSecret
	 */
	public function getTopAppSecret(){
		return $this->topAppSecret;
	}
	
	/**
	 * @param $topAppSecret the $topAppSecret to set
	 */
	public function setTopAppSecret($topAppSecret){
		$this->topAppSecret = $topAppSecret;
	}
	/**
	 * @return the $topUrl
	 */
	public function getTopUrl(){
		return $this->topUrl;
	}

	/**
	 * @param $topUrl the $topUrl to set
	 */
	public function setTopUrl($topUrl){
		$this->topUrl = $topUrl;
	}


}

?>