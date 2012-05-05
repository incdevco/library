<?php

abstract class Inclusive_Db_Table_Abstract 
	extends Zend_Db_Table_Abstract {
	
	protected $_module = null;
	
	protected $_multiDb = null;
	
	public function createUniqueId($length=10) {
	
		return $this->_createUniqueId($length);
	
	}
	
	public function fetchEmpty() {
	
		$rowsetClass = $this->getRowsetClass();
		
		return new $rowsetClass(array(
			'table'=>$this,
			'rowClass'=>$this->getRowClass(),
			'stored'=>true
			));
	
	}
	
	public function getPrimaryKey() {
	
		return $this->_primary;
	
	}
	
	public function service($name,$module=null) {
		
		if (!$module) {
			
			$module = $this->_module;
			
		}
		
		return Inclusive_Locator::service($name,$module);
		
	}
	
	protected function _setupDatabaseAdapter() {
		
		if ($this->_multiDb) {
			
			$multiDb = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('multidb');
			
			if ($multiDb) {
				
				$adapter = $multiDb->getDb($this->_multiDb);
				
				if ($adapter instanceof Zend_Db_Adapter_Abstract) {
					
					return $this->_db = $adapter;
					
				}
				
			}
			
		}
		
		return parent::_setupDatabaseAdapter();
		
	}
	
	protected function _createUniqueId($length=10) {
	
		while(true) {

			$lenth = (int) $length;
		
			$id = substr(md5(uniqid(rand(),true)),0,$length);
			
			$row = $this->find($id);
			
			if (!$row->count()) {
			
				return $id;
			
			}
		
		}
	
	}
	
}