<?php

class Inclusive_Application_Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
	public function _initInclusiveFramework() {
		
		Zend_Loader_Autoloader::getInstance()
			->registerNamespace('Inclusive');
		
	}
	
}