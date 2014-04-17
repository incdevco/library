<?php

class Inclusive_Filter_StringToTime implements Zend_Filter_Interface 
{
	
	public function filter($value) 
	{
		
		return strtotime($value);
		
	}
	
}