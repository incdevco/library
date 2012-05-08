<?php

abstract class Inclusive_Service_Adapter_Abstract {

	protected $_service = null;
	
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