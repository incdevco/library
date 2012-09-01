<?php

class Inclusive_Form extends Zend_Form 
{
	
	protected $_removeConfirm = false;
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	public function addConfirmElement()
	{
	
		$this->addElement(new Inclusive_Form_Element_Confirm());
		
		$this->_removeConfirm = true;
	
	}
	
	public function getValues($suppressArrayNotation=false)
	{
	
		$values = parent::getValues($suppressArrayNotation);
		
		if ($this->_removeConfirm)
		{
		
			unset($values['confirm']);
		
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
	
	public function setService(
		Inclusive_Service_Abstract $service,
		$key
	) 
	{
	
		$this->_services[$key] = $service;
			
		return $this;
		
	}
	
}