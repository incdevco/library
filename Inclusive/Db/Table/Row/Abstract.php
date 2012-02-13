<?php

class Inclusive_Db_Table_Row_Abstract extends Zend_Db_Table_Row_Abstract {
	
	public function service($name,$module=null) {
		
		return $this->getTable()
		    ->service($name,$module);
		
	}
	
	protected function _service($name,$module=null) {
		
		return $this->service($name,$module);
		
	}
	
}