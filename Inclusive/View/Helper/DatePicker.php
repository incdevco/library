<?php

class Inclusive_View_Helper_DatePicker extends Inclusive_View_Helper_Picker 
{
	
	protected $_format = '%c/%e/%Y';
	
	public function datePicker($name,$value=null,$attribs=null) 
	{
		
		return parent::picker($name,$value,$attribs);
		
	}
	
}