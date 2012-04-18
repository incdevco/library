<?php

abstract class Inclusive_Service_Adapter_Abstract {

	protected $_service = null;
	
	protected $_tableClass = 'Inclusive_Db_Table';

	abstract public function add(array $clean);

	abstract public function createUniqueId($length=10);
	
	abstract public function delete($where);
	
	abstract public function edit(array $clean,$where);
	
	abstract public function get($where);

	public function __construct($table=null) 
	{
	
		if ($table == null) {
		
			$class = $this->_tableClass;
		
			$table = new $class();
		
		} 
		
		$this->setTable($table);
		
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