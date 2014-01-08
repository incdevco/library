<?php

class Inclusive_Form_Element_Timestamp extends Inclusive_Form_Element_Text 
{
	
	public function init() 
	{
	
		parent::init();
		
		$this->addFilter(new Inclusive_Filter_StringToTime());
		
		$this->addValidator(new Zend_Validate_Float());
		
	}
	
	
}