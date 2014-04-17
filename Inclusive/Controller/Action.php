<?php

abstract class Inclusive_Controller_Action extends Zend_Controller_Action 
{
	
	protected $_services = array();
	
	protected $_serviceMap = array();
	
	public function getService($key='default')
	{
	
		if (!isset($this->_services[$key]))
		{
			
			$class = $this->_serviceMap[$key];
			
			$this->setService($key,Inclusive_Locator::service($class));
			
		}
		
		return $this->_services[$key];
		
	}
	
	public function setService($key='default',Inclusive_Service_Abstract $service)
	{
		
		$this->_services[$key] = $service;
		
		return $this;
		
	}
	
}