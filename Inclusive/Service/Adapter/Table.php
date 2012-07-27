<?php

abstract class Inclusive_Service_Adapter_Table 
	extends Inclusive_Service_Adapter_Abstract {

	protected $_table = null;
	
	protected $_tableClass = 'Inclusive_Db_Table';
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	public function __construct(
		Inclusive_Service_Abstract $service,
		array $data=array()
		) 
	{
		
		$this->setService($service);
	
		$this->_data = $data;
	
	}
	
	public function createUniqueId($length=10) {
	
		return $this->getTable()
			->createUniqueId($length);
	
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
	
		return $this->_service;
	
	}
	
	public function getTable() {
	
		$class = $this->_tableClass;
	
		if (!($this->_table instanceof $class))
		{
		
			$this->setTable(new $class());
		
		}
		
		return $this->_table;
	
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
	
	public function setTable(
		Inclusive_Db_Table_Abstract $table
		) {
	
		$this->_table = $table;
		
		return $this;
	
	}
	
}