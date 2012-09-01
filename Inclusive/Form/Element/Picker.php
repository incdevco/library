<?php

class Inclusive_Form_Element_Picker
	extends Inclusive_Form_Element_Text
{
	
	public $helper = 'picker';
	
	public function init() {
	
		parent::init();
		
		$this->addFilter(new Inclusive_Filter_StringToTime());
		
	}

}