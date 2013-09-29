<?php

class Inclusive_View_Helper_DatePicker extends Inclusive_View_Helper_Picker 
{
	
	public function datePicker($name,$value=null,$attribs=null) 
	{
		
		return parent::picker($name,$value,$attribs);
		
	}
	
}