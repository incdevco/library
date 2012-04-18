<?php

abstract class Inclusive_Set_Abstract {
	
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
	
}