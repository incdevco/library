<?php

abstract class Inclusive_Set_Abstract implements Iterator {
	
	protected $_service = null;
	
	protected $_set = null;
	
	public function __construct(
		Inclusive_Service_Abstract $service,
		array $set=array()
		)
	{
	
		$this->setService($service);
		
		$this->_set = $set;
	
	}
	
	public function addModel(Inclusive_Model_Abstract $model)
	{
	
		$this->_set[] = $model;
		
		return $this;
	
	}
	
	public function getService() 
	{
	
		return $this->_service;
	
	}
	
	public function setService(
		Inclusive_Service_Abstract $service
		) 
	{
	
		$this->_service = $service;
		
		return $this;
	
	}

	// Iterator Functions
	
	protected $_pointer = 0;
	
	public function current()
	{
	
		return $this->_set[$this->_pointer];
	
	}
	
	public function key()
	{
	
		return $this->_pointer;
	
	}
	
	public function next()
	{
	
		$this->_pointer++;
	
	}
	
	public function rewind()
	{
	
		$this->_pointer = 0;
	
	}
	
	public function valid()
	{
	
		return isset($this->_set[$this->_pointer]);
	
	}

}