<?php

class Inclusive_Auth extends Zend_Auth 
{
	
	public static function getInstance() 
	{
	
        if (null === self::$_instance) 
        {
        
            self::$_instance = new self();
            
        }

        return self::$_instance;
        
    }
    
}