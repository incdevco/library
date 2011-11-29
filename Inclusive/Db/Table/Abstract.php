<?php

abstract class Inclusive_Db_Table_Abstract extends Zend_Db_Table_Abstract {
	
	protected $_module = null;
	
	protected $_multiDb = null;
	
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
	
}