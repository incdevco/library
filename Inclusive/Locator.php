<?php

class Inclusive_Locator {
	
	static protected $_services = array();
	
	static public function service($name,$module=null) {
		
		$class = '';
		
		if ($module) {
			
			$class .= $module;
			
		} else {
			
			$class .= 'Application';
			
		}
		
		$class .= '_Service_';
		
		$class .= $name;
		
		if (!isset(self::$_services[$class])
		    or !(self::$_services[$class] instanceof $class)) {
		    	
	    	self::$_services[$class] = new $class();
	    	
	    }
	    
	    return self::$_services[$class];
		
	}
	
}