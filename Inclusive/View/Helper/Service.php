<?php

class Inclusive_View_Helper_Service extends Zend_View_Helper_Abstract {
	
	public function service($name,$module=null) {
		
		return Inclusive_Locator::service($name,$module);
		
	}
	
}