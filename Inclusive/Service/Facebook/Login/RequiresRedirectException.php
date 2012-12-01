<?php

class Inclusive_Service_Facebook_Login_RequiresRedirectException extends Inclusive_Service_Exception
{

	protected $_redirectUrl = null;

	public function __construct($url)
	{
	
		parent::__construct('Login Requires Redirect To Facebook',0,null);
		
		$this->_redirectUrl = $url;
	
	}
	
	public function getRedirectUrl()
	{
	
		return $this->_redirectUrl;
		
	}

}