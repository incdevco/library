<?php

abstract class Inclusive_Service_Abstract {
	
	protected $_adapter = null;
	
	protected $_adapterClass = null;
	
	protected $_modelClass = null;
	
	protected $_setClass = null;
	
	public function __construct($adapter=null) {
		
		if ($adapter == null) 
		{
		
			$class = $this->_adapterClass;
			
			$adapter = new $class();
		
		}
		
		$this->setAdapter($adapter);
		
	}
	
	public function createUniqueId($length=10) {
	
		return $this->getAdapter()
			->createUniqueId($length);
	
	}
	
	public function fetchNew() {
	
		$class = $this->_modelClass;
		
		return new $class($this);
	
	}
	
	public function getAdapter() {
	
		return $this->_adapter;
	
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
		) {
		
		$adapter->setService($this);
	
		$this->_adapter = $adapter;
		
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
	
}