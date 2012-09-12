<?php

abstract class Inclusive_Service_Abstract 
{
	
	protected $_adapter = null;
	
	protected $_adapterClass = null;
	
	protected $_forms = array();
	
	protected $_formClasses = array();
	
	protected $_modelClass = null;
	
	protected $_setClass = null;
	
	protected $_service = null;
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	public function __construct() 
	{
		
		
		
	}
	
	public function createUniqueId($length=10) 
	{
	
		return $this->getAdapter()
			->createUniqueId($length);
	
	}
	
	public function fetchNew() 
	{
	
		$class = $this->_modelClass;
		
		return new $class($this);
	
	}
	
	public function getAdapter() 
	{
	
		if ($this->_adapter === null)
		{
		
			if ($this->_adapterClass === null)
			{
			
				$this->_throw('No Adapter Class Set');
			
			}
			
			$this->setAdapter($this->_adapterClass);
		
		}
		
		return $this->_adapter;
	
	}
	
	public function getForm($key,$new=false)
	{
	
		if ($new
			or !isset($this->_forms[$key]))
		{
		
			$class = $this->getFormClass($key);
		
			$this->setForm($key,new $class());
			
		}
		
		return $this->_forms[$key];
	
	}
	
	public function getFormClass($key)
	{
	
		if (isset($this->_formClasses[$key]))
		{
		
			return $this->_formClasses[$key];
		
		}
		
		throw new Inclusive_Service_Exception(
			'No Class Found For: '.$key
			);
			
	}
	
	public function getModelClass()
	{
	
		return $this->_modelClass;
		
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
	
		return $this->_throw('No Service Found');
	
	}
	
	public function getSetClass()
	{
	
		return $this->_setClass;
		
	}
	
	public function setAdapter($adapter) 
	{
		
		if (is_string($adapter))
		{
		
			$adapter = new $adapter($this);
		
		}
		else 
		{
		
			if ($adapter instanceof Inclusive_Service_Adapter_Abstract)
			{
			
				$adapter->setService($this);
				
			}
			else 
			{
			
				return $this->_throw('Adapter must be instanceof Inclusive_Service_Adapter_Abstract');
			
			}
	
		}
		
		$this->_adapter = $adapter;
		
		return $this;
	
	}
	
	public function setForm($key,Zend_Form $form)
	{
	
		$this->_forms[$key] = $form;
		
		return $this;
	
	}
	
	public function setFormClass($key,$class)
	{
	
		$this->_formClasses[$key] = $class;
		
		return $this;
	
	}
	
	public function setModelClass($class)
	{
	
		$this->_modelClass = $class;
		
		return $this;
		
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
	
	public function setSetClass($class)
	{
	
		$this->_setClass = $class;
		
		return $this;
		
	}
	
	public function _throw($message)
	{
	
		throw new Inclusive_Service_Exception($message);
	
	}
	
	public function _throwForm(Zend_Form $form)
	{
	
		throw 
			new Inclusive_Service_Exception_Form($form);
	
	}
	
}