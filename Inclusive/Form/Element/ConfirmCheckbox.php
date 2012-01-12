<?php

class Inclusive_Form_Element_ConfirmCheckbox extends 
Zend_Form_Element_Checkbox {
	
	public function __construct($spec='confirm',$options=null) {
		
		parent::__construct($spec,$options);
		
	}
	
	public function init() {
		
		$this
			->setCheckedValue(true)
			->setUncheckedValue(false)
			->setRequired(true)
			->setLabel('Confirm:');
		
	}
	
}
