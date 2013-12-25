<?php

class Inclusive_Service_Acl
{
	
	protected $_acl = null;
	
	public function __construct()
	{
		
		$this->_acl = new Inclusive_Acl();
		
		$this->init();
	
	}
	
	public function init()
	{
	
		
	
	}
	
	public function isAllowed(Inclusive_Model_Abstract $model,$privilege)
	{
		
		return $this->_acl->isAllowed(null,$model,$privilege);
	
	}

}