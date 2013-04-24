<?php

/**
 * @author taobao 2011-5-25 下午02:56:20
 */
class TaobaoClient {
	
	/**
	 * 执行请求
	 * @param TaobaoQuery $query
	 * @return array
	 */
	public function execute(TaobaoQuery $query){
		$apiParams = $query->getApiParams();
		$sysParams = $query->getSysParams();
		//$sysParams['partner_id'] = 'top-sdk-php-20101125';
		$sysParams['app_key'] = $query->getTopAppkey();
		$sysParams['session'] = $query->getTopSession();
		$sysParams['sign_method'] = 'md5';
		$sysParams['v'] = '2.0';
		$sysParams['timestamp'] = date('Y-m-d H:i:s');
		$sysParams['sign'] = $this->generateSign($query->getTopAppSecret(), array_merge($apiParams, $sysParams));
		$requestUrl = $query->getTopUrl() . '?';
		foreach( $sysParams as $k => $v ) {
			$requestUrl .= "$k=" . urlencode($v) . '&';
		}
		$requestUrl = substr($requestUrl, 0, - 1);
		try {
			$response = $this->curl($requestUrl, $apiParams);
		} catch ( Exception $e ) {
			print_r($e);
			return;
		}
		$result = null;
		if ( $sysParams['format'] == 'json' ) {
			$result = json_decode($response, true);
		
		} elseif ( $sysParams['format'] == 'xml' ) {
			$result = @simplexml_load_string($response);
		}
		return $result;
	}
	
	/**
	 * 生成签名
	 * @param $appSecret
	 * @param $params
	 */
	private function generateSign($appSecret, $params){
		ksort($params);
		$sign = $appSecret;
		foreach( $params as $k => $v ) {
			if ( "@" != substr($v, 0, 1) ) {
				$sign .= "$k$v";
			}
		}
		unset($k, $v);
		$sign .= $appSecret;
		return strtoupper(md5($sign));
	}
	
	private function curl($url, $postFields = null){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		if ( isset($postFields) && is_array($postFields) && count($postFields) > 0 ) {
			$postBodyString = "";
			$postMultipart = false;
			foreach( $postFields as $k => $v ) {
				//判断是不是文件上传
				if ( "@" != substr($v, 0, 1) ) {
					$postBodyString .= "$k=" . urlencode($v) . "&";
					//文件上传用multipart/form-data，否则用www-form-urlencoded
				} else {
					$postMultipart = true;
				}
			}
			unset($k, $v);
			curl_setopt($ch, CURLOPT_POST, true);
			if ( $postMultipart ) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
			} else {
				curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, - 1));
			}
		}
		$reponse = curl_exec($ch);
		if ( curl_errno($ch) ) {
			throw new Exception(curl_error($ch), 0);
		} else {
			$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if ( 200 !== $httpStatusCode ) {
				throw new Exception($reponse, $httpStatusCode);
			}
		}
		curl_close($ch);
		return $reponse;
	}
}
?>