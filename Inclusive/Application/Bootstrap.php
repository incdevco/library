<?php

class Inclusive_Application_Bootstrap extends Zend_Application_Bootstrap_Bootstrap 
{
	
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