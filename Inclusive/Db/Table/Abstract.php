<?php

abstract class Inclusive_Db_Table_Abstract extends Zend_Db_Table_Abstract {
	
	protected $_module = null;
	
	public function service($name,$module=null) {
		
		if (!$module) {
			
			$module = $this->_module;
			
		}
		
		return Inclusive_Locator::service($name,$module);
		
	}
	
}