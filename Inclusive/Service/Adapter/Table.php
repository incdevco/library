<?php

abstract class Inclusive_Service_Adapter_Table 
	extends Inclusive_Service_Adapter_Abstract {

	protected $_table = null;
	
	protected $_tableClass = 'Inclusive_Db_Table';
	
	public function __construct($table=null) {
	
		if ($table == null) {
		
			$class = $this->_tableClass;
			
			$table = new $class();
		
		}
		
		$this->setTable($table);
	
	}
	
	public function createUniqueId($length=10) {
	
		return $this->getTable()
			->createUniqueId($length);
	
	}
	
	public function getTable() {
	
		return $this->_table;
	
	}
	
	public function setTable(
		Inclusive_Db_Table_Abstract $table
		) {
	
		$this->_table = $table;
	
	}
	
	protected function _throw($message)
	{
	
		throw new Inclusive_Service_Exception($message);
	
	}
	
}