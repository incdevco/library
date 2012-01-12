<?php

class Inclusive_Auth extends Zend_Auth {
	
	public function hasIdentity() {
		
		$result = parent::hasIdentity();
		
		if ($result) {
			
			if (($this->getIdentity() instanceof Inclusive_Auth_User)) {
				
				return true;
				
			}
			
		}
		
		return false;
		
	}
	
}