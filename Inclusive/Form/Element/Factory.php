<?php

class Inclusive_Form_Element_Factory {
	
	static function factory($spec,$options=null) {
		
		$type = 'hidden';
		
		if (isset($options['type'])) {
			
			$type = strtolower($options['type']);
			
			if (isset($options['type'])) {
				
				unset($options['type']);
				
			}
			
		}
		
		if ($type == 'select') {
	  
            if (isset($options['notRequired'])) {
                        
                unset($options['notRequired']);
                        
            }
                        
            if (isset($options['where'])) {
                        
                unset($options['where']);
                        
            }
                    
			$element = new Zend_Form_Element_Select($spec,$options);
			
		} else {
			
			$element = new Zend_Form_Element_Hidden($spec,$options);
			
		}
		
		return $element;
		
	}
	
}