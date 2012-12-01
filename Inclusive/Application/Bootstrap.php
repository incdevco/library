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
		
	}
	
	public function _initDateFormat() {
	
		if (!defined('DATE_FORMAT')) {
		
			define('DATE_FORMAT','n/j/Y h:i:s a');
		
		}
	
	}
	
	public function _initRequestTime()
	{
	
		if (!defined('REQUEST_TIME'))
		{
		
			define('REQUEST_TIME',
				(isset($_SERVER['REQUEST_TIME']) && $_SERVER['REQUEST_TIME']) ? 
					$_SERVER['REQUEST_TIME'] : microtime(true));
		
		}
		
	}
	
}