<?php

class Inclusive_Application_Bootstrap extends Zend_Application_Bootstrap_Bootstrap 
{
	
	public function _initEventManager()
	{
	
		
	
	}
	
	public function _initInclusiveFramework() 
	{
		
		$this->bootstrap('View');
		
		$view = $this->getResource('View');
		
		if ($view) 
		{
		
			$view->addHelperPath('Inclusive/View/Helper','Inclusive_View_Helper');
		
		}
		
	}
	
	public function _initJQuery() 
	{
		
		$this->bootstrap('View');
		
		$view = $this->getResource('View');
		
		if ($view) 
		{
		
			$view->addHelperPath('ZendX/JQuery/View/Helper','ZendX_JQuery_View_Helper');
		
		}
		
	}
	
	public function _initDateFormat() 
	{
	
		if (!defined('DATE_FORMAT')) 
		{
		
			define('DATE_FORMAT','n/j/Y h:i:s a');
		
		}
	
	}
	
	public function _initRequestTime()
	{
	
		if (!defined('REQUEST_TIME'))
		{
			
			if (isset($_SERVER['REQUEST_TIME_FLOAT']) && $_SERVER['REQUEST_TIME_FLOAT'])
			{
			
				$time = $_SERVER['REQUEST_TIME_FLOAT'];
				
			}
			elseif (isset($_SERVER['REQUEST_TIME']) && $_SERVER['REQUEST_TIME'])
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