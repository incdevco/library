<?php

class Inclusive_Form_Element_TimePicker extends Inclusive_Form_Element_Picker 
{
	
	public $helper = 'timePicker';
	
	protected $_formatConstant = 'TIME_FORMAT';
	
	protected $_returnTimestamp = true;
	
}