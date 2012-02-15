<?php

class Inclusive_Form_Element_TimestampPicker extends Zend_Form_Element_Text {
	
	public $helper = 'timestampPicker';
	
	public function init() {
	
		parent::init();
		
		$this->addFilter(new Inclusive_Filter_StringToTime());
		
	}
	
}