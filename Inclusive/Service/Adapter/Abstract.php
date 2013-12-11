<?php

abstract class Inclusive_Service_Adapter_Abstract 
{
	
	protected $__services = array();
	
	protected $_serviceClasses = array();
	
	public function __construct($options=null) 
	{
		
		// Backwards Compatibility
		if ($options instanceof Inclusive_Service_Abstract)
		{
		
			$service = $options;
			
			$options = array('service'=>$service);
		
		}
		
		if (isset($options['service']))
		{
		
			$this->setService($options['service']);
			
		}
	
	}
	
	public function getAcl()
	{
	
		return $this->getService()->getAcl();
	
	}
	
	public function getService($key=null) 
	{
	
		if ($key != null && isset($this->_serviceClasses[$key]))
		{
		
			$class = $this->_serviceClasses[$key];
		
		}
		else 
		{
		
			$class = $key;
		
		}
	
		if ($class != null)
		{
		
			if (!isset($this->__services[$key])
				or !($this->__services[$key] instanceof $class))
			{
			
				$this->setService(new $class(),$key);
			
			}
			
			return $this->__services[$key];
		
		}
	
		return $this->__service;
	
	}
	
	public function setService(Inclusive_Service_Abstract $service,$key=null) 
	{
	
		if (null === $key)
		{
			
			$this->__service = $service;
			
		}
		else 
		{
		
			$this->__services[$key] = $service;
		
		}
		
		return $this;
	
	}
	
	protected function _throw($message)
	{
	
		throw new Inclusive_Service_Exception($message);
	
	}
	
}