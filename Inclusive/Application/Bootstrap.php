<?php

class Inclusive_Application_Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
	public function _initInclusiveFramework() {
		
		Zend_Loader_Autoloader::getInstance()->registerNamespace('Inclusive');
		
		$this->bootstrap('View');
		
		$view = $this->getResource('View');
		
		$view
			->addHelperPath(
				'ZendX/JQuery/View/Helper',
				'ZendX_JQuery_View_Helper');
		
	}
	
}