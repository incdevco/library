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
		$options=null
		) 
	{
	
		$multiOptions = array();
		
		if (!isset($options['required'])
			or $options['required']) {
			
			$multiOptions[''] = 
				(isset($options['notRequired'])) ?
					$options['notRequired'] : 'None';
					
		}
		
		$method = 'fetchAll';
		
		if ($service instanceof Inclusive_Service_Abstract)
		{
		
			$method = 'find';
		
		}
		
		$set = $service
			->$method((isset($options['where'])) ? 
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