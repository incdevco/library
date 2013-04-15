<?php

class Inclusive_Form_Element_DatePicker extends Inclusive_Form_Element_Picker 
{
	
	public $helper = 'datePicker';
	
	protected $_formatConstant = 'DATE_FORMAT';
	
	protected $_returnTimestamp = false;
	
}