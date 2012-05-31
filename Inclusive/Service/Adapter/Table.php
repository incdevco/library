<?php

abstract class Inclusive_Service_Adapter_Table 
	extends Inclusive_Service_Adapter_Abstract {

	protected $_table = null;
	
	protected $_tableClass = 'Inclusive_Db_Table';
	
	public function createUniqueId($length=10) {
	
		return $this->getTable()
			->createUniqueId($length);
	
	}
	
	public function getTable() {
	
		$class = $this->_tableClass;
	
		if (!($this->table instanceof $class))
		{
		
			$this->setTable(new $class());
		
		}
		
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