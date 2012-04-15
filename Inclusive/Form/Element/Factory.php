<?php

class Inclusive_Form_Element_Factory {
	
	static function createMultiOptions(
		Inclusive_Db_Table_Abstract $service,
		$key,
		$value,
		$options=null
		) {
	
		$multiOptions = array();
		
		if (!isset($options['required'])
			or $options['required']) {
			
			$multiOptions[''] = 
				(isset($options['notRequired'])) ?
					$options['notRequired'] : 'None';
					
		}
		
		$rows = $service
			->fetchAll((isset($options['where'])) ? 
				$options['where'] : null);
				
		foreach ($rows as $row) {
		
			$multiOptions[$row->$key] = $row->$value;
		
		}
		
		return $multiOptions;
	
	}
	
	static function determineType($options=null) {
		
        $type = 'hidden';
        
        if (isset($options['type'])) {
            
            $type = strtolower($options['type']);
            
        }
        
        return $type;
        
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
	                    
				$element = new Zend_Form_Element_Select(
					$spec,
					$options
					);
				
			} elseif ($type == 'text') {
				
				$element = new Zend_Form_Element_Text(
					$spec,
					$options
					);
				
			} else {
				
				$element = new Zend_Form_Element_Hidden(
					$spec,
					$options
					);
				
				$element
					->removeDecorator('Label')
					->removeDecorator('DtDdWrapper');
				
			}
			
		}
		
		return $element;
		
	}
	
	static function service($service,$module=null) {
	
		if (isset(self::$_module)) {
		
			$module = self::$_module;
		
		}
	
		return 
			Inclusive_Locator::service($service,$module);
	
	}
	
}