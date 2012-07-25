<?php

class Inclusive_View_Helper_DateTimePicker 
	extends Inclusive_View_Helper_Picker 
{
	
	public function dateTimePicker($name,$value=null,$attribs=null) {
		
		return parent::picker($name,$value,$attribs);
		
	}
	
}