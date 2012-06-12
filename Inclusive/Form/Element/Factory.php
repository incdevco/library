<?php

class Inclusive_Form_Element_Factory {

	static $_hiddenClass = 'Zend_Form_Element_Hidden';

	static $_multiselectClass = 
		'Zend_Form_Element_Multiselect';

	static $_selectClass = 'Zend_Form_Element_Select';

	static $_textClass = 'Zend_Form_Element_Text';
	
	static function createMultiOptions(
		$service,
		$key,
		$value,
		$options=null,
		$method='fetchAll'
		) 
	{
	
		$multiOptions = array();
		
		if (!isset($options['required'])
			or $options['required']) {
			
			$multiOptions[''] = 
				(isset($options['notRequired'])) ?
					$options['notRequired'] : 'None';
					
		}
		
		$set = $service->$method((isset($options['where'])) ? 
			$options['where'] : null);
				
		foreach ($set as $model) {
		
			$multiOptions[$model->$key] = $model->$value;
		
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
	
	static function factory($spec,$options=null) 
	{
		
		$type = self::determineType($options);
			
		if (isset($options['type'])) {

			unset($options['type']);
			
        } 
        
		if (isset($options['elementClass'])) {
			
			$class = $options['elementClass'];
			
			unset($options['elementClass']);
			
		} else {
			
			if ($type == 'select') {
		  
	            $class = self::$_selectClass;
	            
			} elseif ($type == 'multiselect') {
				
				$class = self::$_multiselectClass;
				
			} elseif ($type == 'text') {
				
				$class = self::$_textClass;
				
			} else {
				
				$class = self::$_hiddenClass;
				
			}
			
		}
		
		$element = new $class($spec,$options);
		
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
