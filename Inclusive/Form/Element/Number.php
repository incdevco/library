<?php

class Inclusive_Form_Element_Number extends Inclusive_Form_Element_Text 
{
	
	public function init()
	{
	
		$this
			->addFilter(new Inclusive_Filter_RemoveCommas())
			->addValidator(new Zend_Validate_Float());
	
	}
	
}