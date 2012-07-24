<?php

abstract class Inclusive_Service_Adapter_Abstract {

	protected $_service = null;
	
	protected $_services = null;
	
	protected $_serviceClasses = array();
	
	public function getService($key=null) 
	{
	
		if ($key != null)
		{
		
			$class = $this->getServiceClass($key);
			
			if (!isset($this->_services[$key])
				or !($this->_services[$key] instanceof $class))
			{
			
				$this->setService(new $class(),$key);
			
			}
			
			return $this->_services[$key];
		
		}
		else 
		{
		
			return $this->_service;
		
		}
	
		throw new Inclusive_Service_Exception('Service Not Set');
		
	}
	
	public function getServiceClass($key)
	{
	
		if (isset($this->_serviceClasses[$key]))
		{
		
			return $this->_serviceClasses[$key];
		
		}
		
		throw new Inclusive_Service_Exception('Class not set for '.$key);
	
	}
	
	public function setService(
		Inclusive_Service_Abstract $service,
		$key=null
		)
	{
	
		if ($key != null)
		{
		
			$class = $this->getServiceClass($key);
			
			if ($service instanceof $class)
			{
		
				$this->_services[$key] = $service;
		
			}
			else 
			{
			
				throw new Inclusive_Service_Exception('Not instance of '.$class);
			
			}
		
		}
		else 
		{
		
			$this->_service = $service;
			
		}
	
		return $this;
		
	}

}