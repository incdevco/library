<?php

class Inclusive_Form extends Zend_Form 
{
	
	protected $_attribs = array(
		'class'=>'inclusive'
		);
	
	protected $_ifEmptySetNull = array();
	
	protected $_ifEmptyUnset = array();
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	public function __construct($options=null)
	{
	
		parent::__construct($options);
		
	}
	
	public function getValues($suppressArrayNotation=false)
	{
	
		$values = parent::getValues($suppressArrayNotation);
		
		foreach ($this->_ifEmptyUnset as $key)
		{
			
			if ($this->isValueEmpty($values[$key]))
			{
			
				unset($values[$key]);
			
			}
		
		}
		
		foreach ($this->_ifEmptySetNull as $key)
		{
		
			if ($this->isValueEmpty($values[$key]))
			{
			
				$values[$key] = null;
			
			}
		
		}
		
		return $values;
		
	}
	
	public function getService($key) 
	{
	
		if (isset($this->_serviceClasses[$key]))
		{
		
			$class = $this->_serviceClasses[$key];
		
		}
		else 
		{
		
			$class = $key;
		
		}
	
		if (!isset($this->_services[$key])
			or !($this->_services[$key] instanceof $class))
		{
		
			$this->setService(new $class(),$key);
		
		}
		
		return $this->_services[$key];
		
	}
	
	public function isValueEmpty($value)
	{
		
		if (null === $value)
		{
		
			return true;
		
		}
		
		if (is_string($value) && $value == '')
		{
		
			return true;
		
		}
		elseif (is_array($value) && count($value) == 0) 
		{
		
			return true;
			
		}
		
		return false;
	
	}
	
	public function setService(Inclusive_Service_Abstract $service,$key) 
	{
	
		$this->_services[$key] = $service;
			
		return $this;
		
	}
	
}