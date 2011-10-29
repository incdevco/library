<?php

abstract class Inclusive_Controller_Action extends Zend_Controller_Action {
	
	protected $_module = null;
	
	protected function _service($name,$module=null) {
		
		if (!$module) {
			
			$module = $this->_module;
			
		}
		
		return Inclusive_Locator::service($name,$module);
		
	}
	
}