<?php

class Inclusive_Form_Element_Factory {
	
	static function determineType($options=null) {
		
        $type = 'hidden';
        
        if (isset($options['type'])) {
            
            $type = strtolower($options['type']);
            
        }
        
        return $type;
        
	}
	
	static function service($service,$module=null) {
	
		return Inclusive_Locator::service($service,$module);
	
	}
	
	static function factory($spec,$options=null) {
		
		$type = self::determineType($options);
			
		if (isset($options['type'])) {

			unset($options['type']);
			
        } 
        
		if (isset($options['elementClass'])) {
			
			$class = $options['elementClass'];
			
			unset($options['elementClass']);
			
			$element = new $class($spec,$options);
			
		} else {
			
			if ($type == 'select') {
		  
	            if (isset($options['notRequired'])) {
	                        
	                unset($options['notRequired']);
	                        
	            }
	                        
	            if (isset($options['where'])) {
	                        
	                unset($options['where']);
	                        
	            }
	                    
				$element = new Zend_Form_Element_Select($spec,$options);
				
			} elseif ($type == 'multiselect') {
				
				$element = new Zend_Form_Element_Multiselect($spec,$options);
				
			} elseif ($type == 'text') {
				
				$element = new Zend_Form_Element_Text($spec,$options);
				
			} else {
				
				$element = new Zend_Form_Element_Hidden($spec,$options);
				
			}
			
		}
		
		return $element;
		
	}
	
}