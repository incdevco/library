<?php

class Inclusive_Db_Statement_Pdo_Encrypt extends Zend_Db_Statement_Pdo {

	public function _execute(array $params = null) {
	
		if ($params !== null) {
		
			$encrypted = array();
			
			foreach ($params as $key => $param) {
			
				$encrypted[$key] = 
			
			}
		
		}
	
		return parent::_execute($params);
	
	}

}