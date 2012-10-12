<?php

abstract class Inclusive_Service_Adapter_Log extends Inclusive_Service_Adapter_Abstract 
{

	protected $_logger = null;
	
	protected $_loggerClass = 'Zend_Log';
	
	public function __construct(Inclusive_Service_Abstract $service) 
	{
		
		$this->setService($service);
	
	}
	
	public function getLogger() 
	{
	
		$class = $this->getLoggerClass();
	
		if (!$this->_logger instanceof $class)
		{
		
			$this->setLogger(new $class());
		
		}
		
		return $this->_logger;
	
	}
	
	public function getLoggerClass()
	{
	
		return $this->_loggerClass;
		
	}
	
	public function setLogger(Zend_Log $logger) 
	{
	
		$this->_logger = $logger;
		
		return $this;
	
	}
	
}