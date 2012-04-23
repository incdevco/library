<?php

class Inclusive_Service_Paypal
{

	protected $_env = 'sandbox';

	public function createDoExpressCheckoutRequest($data)
	{
	
		$request = new Inclusive_Service_Paypal_Request_DoExpressCheckout();
		
		return $request;
	
	}

	public function createGetExpressCheckoutDetailsRequest(
		$data
		)
	{
	
		$request = new Inclusive_Service_Paypal_Request_GetExpressCheckoutDetails();
		
		return $request;
	
	}

	public function createSetExpressCheckoutRequest($data)
	{
	
		$request = new Inclusive_Service_Paypal_Request_SetExpressCheckout();
		
		return $request;
	
	}

	public function doExpressCheckout(
		Inclusive_Service_Paypal_Request_DoExpressCheckout $request
		)
	{
	
		return
		new Inclusive_Service_Paypal_Response_DoExpressCheckout();
		
	}
	
	public function setExpressCheckout(
		Inclusive_Service_Paypal_Request_SetExpressCheckout $request
		)
	{
	
		$response = new Inclusive_Service_Paypal_Response_SetExpressCheckout();
		
		return $response;
	
	}
	
	public function getExpressCheckoutDetails(
		Inclusive_Service_Paypal_Request_GetExpressCheckoutDetails $request
		)
	{
	
		$response = new Inclusive_Service_Paypal_Response_GetExpressCheckoutDetails();
		
		return $response;
	
	}

	public function getExpressCheckoutRedirectUrl($token)
	{
	
		$url = 'https://';
	
		if ($this->_env == 'production')
		{
		
			throw new Zend_Exception('Not Implemented Yet');
		
		}
		else 
		{
		
			$url .= 'www.sandbox.paypal.com';
			
		}
		
		$url .= '/webscr?cmd=_express-checkout&token=';
		
		$url .= $token;
		
		return $url;
	
	}
	
}