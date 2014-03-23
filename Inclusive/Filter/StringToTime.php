<?php

class Inclusive_Filter_StringToTime implements Zend_Filter_Interface 
{
	
	public function filter($value) 
	{
		
		$result = strtotime($value);
		
		if ($result)
		{
		
			return $result;
		
		}
		
		return $value;
		
	}
	
}