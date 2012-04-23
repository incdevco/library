<?php

abstract class Inclusive_Service_Adapter_Abstract {

	protected $_service = null;
	
	abstract public function add(array $clean);

	abstract public function createUniqueId($length);
	
	abstract public function delete($where);
	
	abstract public function edit(array $clean,$where=null);
	
	abstract public function get($where);

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