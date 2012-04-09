<?php

class Inclusive_Application_Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
	public function _initInclusiveFramework() {
		
		Zend_Loader_Autoloader::getInstance()
			->registerNamespace('Inclusive');
		
	}
	
	public function _initDateFormat() {
	
		if (!defined('DATE_FORMAT')) {
		
			define('DATE_FORMAT','n/j/Y h:i:s a');
		
		}
	
	}
	
}