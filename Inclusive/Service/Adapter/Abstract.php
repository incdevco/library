<?php

abstract class Inclusive_Service_Adapter_Abstract 
{

	protected $_acl = null;
	
	protected $_aclClass = null;
	
	protected $_service = null;

	protected $_services = array();
	
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
	
	public function fetchNew(array $data=array())
	{
	
		$class = $this->getService()
			->getModelClass();
			
		return new $class($this->getService(),$data);
	
	}
	
	public function getAcl()
	{
	
		if ($this->_acl === null)
		{
		
			$class = $this->_aclClass;
			
			if ($class)
			{
			
				$this->_acl = new $class();
			
			}
		
		}
		
		return $this->_acl;
	
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
		
			if (!isset($this->_services[$key]) or !($this->_services[$key] instanceof $class))
			{
			
				$this->setService(new $class(),$key);
			
			}
			
			return $this->_services[$key];
		
		}
	
		return $this->_service;
	
	}
	
	public function setAcl($acl)
	{
	
		$this->_acl = $acl;
		
		return $this;
	
	}
	
	public function setService(Inclusive_Service_Abstract $service,$key=null) 
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