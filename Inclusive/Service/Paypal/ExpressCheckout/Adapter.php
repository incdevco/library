<?php

abstract class Inclusive_Service_Paypal_ExpressCheckout_Adapter extends Inclusive_Service_Adapter_Abstract
{
	
	protected $_brandName = null;
	
	protected $_customerServiceNumber = null;
	
	protected $_version = '94.0';
	
	protected $_productionApiUrl = 'https://api-3t.paypal.com/nvp';
	
	protected $_productionPwd = null;
	
	protected $_productionRedirectUrl = 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=';
	
	protected $_productionSignature = null;
	
	protected $_productionUser = null;
	
	protected $_sandboxApiUrl = 'https://api-3t.sandbox.paypal.com/nvp';
	
	protected $_andboxPwd = null;
	
	protected $_sandboxRedirectUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=';
	
	protected $_sandboxSignature = null;
	
	protected $_sandboxUser = null;
	
	/*
	*	Implement to access the ExpressCheckout before DoExpressCheckout
	* 	Must return the $data array
	*/
	abstract function beforeDo($expressCheckout,array $data);
	
	/*
	*	Implement to access the ExpressCheckout after DoExpressCheckout
	*/
	abstract function afterDo($expressCheckout,array $data,array $response);
	
	/*
	*	Implement to access the ExpressCheckout before SetExpressCheckout
	* 	Must return the $data array
	*/
	abstract function beforeSet(array $clean,array $data);
	
	/*
	*	Implement to access the ExpressCheckout after SetExpressCheckout, before redirect.
	*/
	abstract function afterSet(array $data,array $response);
	
	public function ddo(array $clean,$env='sandbox')
	{
	
		$expressCheckout = $this->get($clean);
	
		$url = $this->getApiUrl($env);
		
		$data = $this->getData($env);
		
		$data['METHOD'] = 'DoExpressCheckoutPayment';
		$data['TOKEN'] = $clean['token'];
		$data['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';
		$data['PAYERID'] = $clean['PayerID'];
		$data['PAYMENTREQUEST_0_AMT'] = $expressCheckout['PAYMENTREQUEST_0_AMT'];
			
		$data = $this->beforeDo($expressCheckout,$data);
		
		$client = new Zend_Http_Client($url);
		$client->setParameterPost($data);
		
		$response = $client->request('POST');
		
		parse_str(urldecode($response->getBody()),$params);
		
		if ($params['ACK'] == 'Success')
		{
		
			return $this->afterDo($expressCheckout,$data,$params);
			
		}
		
		return $this->_throw('GetExpressCheckout Error: '.$response->getBody());
	
	}
	
	public function get(array $clean,$env='sandbox')
	{
	
		$url = $this->getApiUrl($env);
		
		$data = $this->getData($env);
		
		$data['METHOD'] = 'GetExpressCheckoutDetails';
		$data['TOKEN'] = $clean['token'];
		
		$client = new Zend_Http_Client($url);
		$client->setParameterPost($data);
		
		$response = $client->request('POST');
		
		parse_str(urldecode($response->getBody()),$params);
		
		if ($params['ACK'] == 'Success')
		{
		
			return $params;
		
		}
		
		return $this->_throw('GetExpressCheckout Error: '.$response->getBody());
	
	}
	
	public function getApiUrl($env='sandbox')
	{
	
		if ($env == 'production')
		{
		
			return $this->_productionApiUrl;
		
		}
		
		return $this->_sandboxApiUrl;
		
	}
	
	public function getBrandName()
	{
	
		return $this->_brandName;
	
	}
	
	public function getCustomerServiceNumber()
	{
	
		return $this->_customerServiceNumber;
	
	}
	
	public function getData($env='sandbox')
	{
		
		$data = array(
			'USER'=>$this->getUser($env),
			'PWD'=>$this->getPwd($env),
			'SIGNATURE'=>$this->getSignature($env),
			'VERSION'=>$this->getVersion()
			);
			
		return $data;
		
	}
	
	public function getPwd($env='sandbox')
	{
	
		if ($env == 'production')
		{
		
			return $this->_sandboxPwd;
		
		}
		
		return $this->_sandboxPwd;
	
	}
	
	public function getRedirectUrl($token,$env='sandbox')
	{
	
		if ($env == 'production')
		{
		
			$url = $this->_productionRedirectUrl;
		
		}
		else 
		{
		
			$url = $this->_sandboxRedirectUrl;
		
		}
		
		return $url.$token;
		
	}
	
	public function getSignature($env='sandbox')
	{
	
		if ($env == 'production')
		{
		
			return $_productionSignature;
			
		}
		
		return $this->_sandboxSignature;
	
	}
	
	public function getUser($env='sandbox')
	{
	
		if ($env == 'production')
		{
		
			return $this->_productionUser;
			
		}
		
		return $this->_sandboxUser;
	
	}
	
	public function getVersion()
	{
	
		return $this->_version;
		
	}
	
	public function set(array $clean,$env='sandbox')
	{
	
		$url = $this->getApiUrl($env);
		
		$data = $this->getData($env);
		
		$data['NOSHIPPING'] = '1';
		$data['ALLOW_NOTE'] = '1';
		$data['BRAND_NAME'] = $this->getBrandName();
		$data['CUSTOMERSERVICENUMBER'] = $this->getCustomerServiceNumber();
		$data['METHOD'] = 'SetExpressCheckout';
		$data['RETURNURL'] = $clean['return_url'];
		$data['CANCELURL'] = $clean['cancel_url'];
		$data['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';
		$data['PAYMENTREQUEST_0_AMT'] = $clean['amount'];
		$data['PAYMENTREQUEST_0_ITEMAMT'] = $clean['amount'];
			
		$data = $this->beforeSet($clean,$data);
		
		$client = new Zend_Http_Client($url);
		$client->setParameterPost($data);
		
		$response = $client->request('POST');
		
		parse_str(urldecode($response->getBody()),$params);
		
		if ($params['ACK'] == 'Success')
		{
		
			$this->afterSet($clean,$params);
		
			$redirect = $this->getRedirectUrl($params['TOKEN'],$env);
		
			return $redirect;
		
		}
		
		return $this->_throw('SetExpressCheckout Error: '.$response->getBody());
	
	}

}