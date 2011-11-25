<?php

class Inclusive_Filter_StringToTime implements Zend_Filter_Interface {
	
	public function filter($value) {
		
		if (is_int($value)) {
			
			return $value;
			
		}
		
		$result = strtotime($value);
		
		if ($result) {
			
			return $result;
			
		}
		
	}
	
}