<?php

class Inclusive_View_Helper_TimestampPicker 
	extends Inclusive_View_Helper_Picker {
	
	public function timestampPicker($name,$value=null,$attribs=null) {
		
		return parent::picker($name,$value,$attribs);
		
	}
	
}