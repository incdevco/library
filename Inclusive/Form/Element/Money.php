<?php

class Inclusive_Form_Element_Money 
	extends Inclusive_Form_Element_Number 
{
	
	public function init()
	{
	
		parent::init();
	
		$this
			->addFilter(new Inclusive_Filter_RemoveDollarSign());
	
	}
	
}