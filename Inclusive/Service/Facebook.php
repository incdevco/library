<?php

class Inclusive_Service_Facebook
{

	protected $_env = 'sandbox';
	
	public function callDoExpressCheckout(array $data)
	{
	
		
	
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