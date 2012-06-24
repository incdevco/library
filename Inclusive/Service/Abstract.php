<?php

abstract class Inclusive_Service_Abstract {
	
	protected $_adapter = null;
	
	protected $_adapterClass = null;
	
	protected $_modelClass = null;
	
	protected $_setClass = null;
	
	protected $_forms = array();
	
	protected $_formClasses = array();
	
	public function __construct($adapter=null) 
	{
		
		if ($adapter == null) 
		{
		
			$class = $this->_adapterClass;
			
			$adapter = new $class();
		
		}
		
		$this->setAdapter($adapter);
		
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
	
	public function getSetClass()
	{
	
		return $this->_setClass;
		
	}
	
	public function setAdapter(
		Inclusive_Service_Adapter_Abstract $adapter
	) 
	{
		
		$adapter->setService($this);
	
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
	
	public function setSetClass($class)
	{
	
		$this->_setClass = $class;
		
		return $this;
		
	}
	
	public function _throwForm(Zend_Form $form)
	{
	
		throw 
			new Inclusive_Service_Exception_Form($form);
	
	}
	
}