<?php

class Inclusive_View_Helper_Auth extends Zend_View_Helper_Abstract {
	
	public function auth() {
		
		return Inclusive_Auth::getInstance();
		
	}
	
}