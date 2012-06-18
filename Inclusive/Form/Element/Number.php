<?php

class Inclusive_Form_Element_Number 
	extends Inclusive_Form_Element_Text 
{
	
	public function init()
	{
	
		$this
			->addFilter(new Zend_Filter_Word_SeparatorToSeparator(',',''));
	
	}
	
}