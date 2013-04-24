<?php

class Inclusive_View_Helper_TimePicker extends Inclusive_View_Helper_Picker 
{
	
	protected $_format = '%h:%i';
	
	public function timePicker($name,$value=null,$attribs=null) 
	{
		
		return parent::picker($name,$value,$attribs);
		
	}
	
}