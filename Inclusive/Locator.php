<?php

class Inclusive_Locator {
	
	static protected $_services = array();
	
	static public function service($class) 
	{
		
		if (!isset(self::$_services[$class])) 
		{
		    	
	    	self::$_services[$class] = new $class();
	    	
	    }
	    
	    return self::$_services[$class];
		
	}
	
}