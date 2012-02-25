<?php

class Inclusive_Application_Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
	public function _initInclusiveFramework() {
		
		Zend_Loader_Autoloader::getInstance()
			->registerNamespace('Inclusive');
		
		$this->bootstrap('View');
		
		$view = $this->getResource('View');
		
		if ($view) {
		
			$view
				->addHelperPath('Inclusive/View/Helper','Inclusive_View_Helper');
		
		}
		
	}
	
	public function _initJQuery() {
		
		$this->bootstrap('View');
		
		$view = $this->getResource('View');
		
		if ($view) {
		
			$view
				->addHelperPath('ZendX/JQuery/View/Helper','ZendX_JQuery_View_Helper');
		
		}
		
		$this->bootstrap('View');
		
		$view = $this->getResource('View');
		
		$view
			->addHelperPath(
				'ZendX/JQuery/View/Helper',
				'ZendX_JQuery_View_Helper');
		
	}
	
}