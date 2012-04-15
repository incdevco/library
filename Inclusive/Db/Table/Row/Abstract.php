<?php

abstract class Inclusive_Db_Table_Row_Abstract 
	extends Zend_Db_Table_Row_Abstract {
	
	protected $_module = null;
	
	public function service($name,$module=null) {
		
		return $this->_service($name,$module);
		
	}
	
	protected function _service($name,$module=null) {
		
		if (!$module) {
			
			$module = $this->_module;
			
		}
		
		return $this->getTable()
		    ->service($name,$module);
		
	}
	
}