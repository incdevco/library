<?php

class Inclusive_Form_Element_Factory {

	static $_hiddenClass = 'Zend_Form_Element_Hidden';

	static $_multiselectClass = 'Zend_Form_Element_Multiselect';

	static $_selectClass = 'Zend_Form_Element_Select';

	static $_textClass = 'Zend_Form_Element_Text';
		
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
	            
	            $class = self::$_selectClass;
	                    
				$element = new $class($spec,$options);
				
			} elseif ($type == 'multiselect') {
				
				$class = self::$_multiselectClass;
				
				$element = new $class($spec,$options);
				
			} elseif ($type == 'text') {
				
				$class = self::$_textClass;
				
				$element = new $class($spec,$options);
				
			} else {
				
				$class = self::$_hiddenClass;
				
				$element = new $class($spec,$options);
				
			}
			
		}
		
		return $element;
		
	}
	
}
