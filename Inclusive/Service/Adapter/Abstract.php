<?php

abstract class Inclusive_Service_Adapter_Abstract 
{

	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	public function __construct(Inclusive_Service_Abstract $service) 
	{
		
		$this->setService($service);
	
	}
	
	public function getService($key=null) 
	{
	
		if ($key != null 
			&& isset($this->_serviceClasses[$key]))
		{
		
			$class = $this->_serviceClasses[$key];
		
		}
		else 
		{
		
			$class = $key;
		
		}
	
		if ($class != null)
		{
		
			if (!isset($this->_services[$key])
				or !($this->_services[$key] instanceof $class))
			{
			
				$this->setService(new $class(),$key);
			
			}
			
			return $this->_services[$key];
		
		}
	
		return $this->_service;
	
	}
	
	public function setService(
		Inclusive_Service_Abstract $service,
		$key=null
	) 
	{
	
		if ($key != null)
		{
		
			$this->_services[$key] = $service;
			
			return $this;
		
		}
	
		$this->_service = $service;
		
		return $this;
	
	}
	
	protected function _throw($message)
	{
	
		throw new Inclusive_Service_Exception($message);
	
	}
	
}