<?php

class Inclusive_Application_Bootstrap extends Zend_Application_Bootstrap_Bootstrap 
{
	
	public function _initInclusiveFramework() 
	{
		
		$this->bootstrap('View');
		
		$view = $this->getResource('View');
		
		if ($view) 
		{
		
			$view->addHelperPath('ZendX/JQuery/View/Helper','ZendX_JQuery_View_Helper');
			$view->addHelperPath('Inclusive/View/Helper','Inclusive_View_Helper');
			
		}
		
	}
	
	public function _initDateFormats() 
	{
	
		if (!defined('DATETIME_FORMAT')) 
		{
		
			define('DATETIME_FORMAT','n/j/Y h:i:s a');
		
		}
		
		if (!defined('DATE_FORMAT')) 
		{
		
			define('DATE_FORMAT','n/j/Y');
		
		}
		
		if (!defined('TIME_FORMAT')) 
		{
		
			define('TIME_FORMAT','h:i:s');
		
		}
		
	}
	
	public function _initRequestTime()
	{
	
		if (!defined('REQUEST_TIME'))
		{
		
			if (isset($_SERVER['REQUEST_TIME']) && $_SERVER['REQUEST_TIME'])
			{
			
				$time = $_SERVER['REQUEST_TIME'];
			
			}
			else 
			{
			
				$time = microtime(true);
			
			}
		
			define('REQUEST_TIME',$time);
		
		}
		
	}
	
}