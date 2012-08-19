<?php

abstract class Inclusive_Controller_Action extends Zend_Controller_Action {

	protected $_services = array();
	
	protected $_serviceClasses = array();

	protected $_module = null;
	
	public function getService($key)
	{
	
		if (!isset($this->_services[$key])
			or !($this->_services[$key] 
				instanceof Inclusive_Service_Abstract))
		{
		
			if (!isset($this->_serviceClasses[$key]))
			{
			
				throw new Inclusive_Controller_Exception(
					'Service Class Not Set: '.$key
					);
			
			}
			
			$class = $this->_serviceClasses[$key];
			
			$this->setService(new $class(),$key);
			
		}
		
		return $this->_services[$key];
		
	}
	
	public function setService(
		Inclusive_Service_Abstract $service,
		$key
	)
	{
	
		if (isset($this->_serviceClasses[$key]))
		{
		
			$class = $this->_serviceClasses[$key];
			
			if (!($service instanceof $class))
			{
			
				throw new Inclusive_Controller_Exception(
					'$service must be an instance of '.$class
					);
			
			}
		
		}
	
		$this->_services[$key] = $service;
		
		return $this;
	
	}
	
	public function setServiceClass($key,$class)
	{
	
		$this->_serviceClasses[$key] = $class;
		
		return $this;
	
	}
	
	protected function _service($name,$module=null) 
	{
		
		if (!$module) {
			
			$module = $this->_module;
			
		}
		
		return Inclusive_Locator::service($name,$module);
		
	}
	
	protected function _getAuth() 
	{
	
		return Inclusive_Auth::getInstance();
	
	}
	
}