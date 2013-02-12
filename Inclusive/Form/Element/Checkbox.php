<?php

class Inclusive_Form_Element_Checkbox extends Zend_Form_Element_Checkbox 
{
	
	public function __construct($spec,$options=null)
	{
		
		if (!isset($options['notCheckedValue']))
		{
		
			$options['notCheckedValue'] = '0';
			
		}
		
		if (!isset($options['checkedValue']))
		{
		
			$options['checkedValue'] = '1';
			
		}
		
		parent::__construct($spec,$options);
	
	}
	
}