<?php

abstract class Inclusive_Service_Facebook_Login_Adapter extends Inclusive_Service_Adapter_Abstract
{

	protected $_appId = null;
	
	protected $_appSecret = null;
	
	protected $_sessionNamespace = 'facebook_login';

	/*
	*	Will be called after a successfull login
	*/
	abstract function afterLogin($facebookUser);

	public function getAppId()
	{
	
		return $this->_appId;
	
	}
	
	public function getAppSecret()
	{
	
		return $this->_appSecret;
	
	}
	
	/*
	*	Can be overridden to gain more access
	*/
	public function getScope()
	{
	
		return 'email';
	
	}
	
	/*
	*	Callback URL for Login
	*/
	abstract function getUrl();

	public function login(array $clean)
	{
		
		$auth = Inclusive_Auth::getInstance();
		
		$appId = $this->getAppId();
		
		$appSecret = $this->getAppSecret();
		
		$session = new Zend_Session_Namespace($this->_sessionNamespace);
		
		$url = $this->getUrl();
		
		if (isset($clean['code']) 
			&& !empty($clean['code'])
			&& isset($clean['state']) 
			&& $session->state == $clean['state'])
		{
		
				$tokenUrl = 'https://graph.facebook.com/oauth/access_token?'
					.'client_id='.$appId
					.'&redirect_uri='.urlencode($url)
					.'&client_secret='.$appSecret
					.'&code='.$clean['code'];
					
				$response = file_get_contents($tokenUrl);
				
				$params = null;
				
				parse_str($response,$params);
				
				$session->access_token = $params['access_token'];
				
				$graphUrl = 'https://graph.facebook.com/me?'
					.'access_token='.$params['access_token'];
					
				$facebookUser = json_decode(file_get_contents($graphUrl));
				
				return $this->afterLogin($facebookUser);
				
		}
		else  
		{
		
			$session->state = md5(uniqid(rand(),true));
			
			$url = 'https://www.facebook.com/dialog/oauth?'.
				'client_id='.$appId
				.'&redirect_uri='.urlencode($url)
				.'&state='.$session->state
				.'&scope='.$this->getScope();
				
			throw new Inclusive_Service_Facebook_Login_RequiresRedirectException($url);
			
		}
		
		return $this->_throw('No Facebook Authentication');
		
	}

}