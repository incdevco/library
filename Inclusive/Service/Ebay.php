<?php

class Inclusive_Service_Ebay {

	public function call(
		Inclusive_Service_Ebay_Request_Abstract $request) {
	
		$sandbox = true;
		
		$api_endpoint = $sandbox ? 
			'https://api.sandbox.ebay.com/ws/api.dll' 
			: 'https://api.ebay.com/ws/api.dll';
		
		$headers = array(
			'X-EBAY-API-COMPATIBILITY-LEVEL:767',
			'X-EBAY-API-DEV-NAME:3ef618c7-5eb1-482a-bfa7-9a9eb28656a8',
			'X-EBAY-API-APP-NAME:Inclusiv-8b9e-4cea-9df7-821b3a8ea661',
			'X-EBAY-API-CERT-NAME:932aafdf-5634-4212-a171-42fc959f76b9',
			'X-EBAY-API-SITEID:0',
			'X-EBAY-API-CALL-NAME:'.$request->callName
			);
			
		//throw new Zend_Exception(htmlentities($request->toXml()));
	
		$connection = curl_init();
		curl_setopt($connection, CURLOPT_URL, $api_endpoint);
		curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($connection, CURLOPT_POST, 1);
		curl_setopt($connection, CURLOPT_POSTFIELDS, $request->toXml());
		curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($connection);
		curl_close($connection);
	
		//throw new Zend_Exception($response);
		
		$response = $request->getResponse($response);
		
		if ($response->isSuccess()) {
			
			return $response; 
			
		} else {
		
			$string = nl2br(htmlentities($response->getResponse()));
		
			throw new Zend_Exception($string);
		
		}
		
	}

}