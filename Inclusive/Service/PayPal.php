<?php

class Inclusive_Service_PayPal
{

	protected $_env = 'sandbox';
	
	public function doExpressCheckout(
		Inclusive_Service_PayPal_Request_DoExpressCheckout $request
		)
	{
	
		return
		new Inclusive_Service_PayPal_Response_DoExpressCheckout();
		
	}
	
	public function callSetExpressCheckout(array $data)
	{
	
		
	
	}

	public function createExpressCheckoutRedirectUrl($token)
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