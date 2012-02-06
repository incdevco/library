<?php

class Inclusive_Filter_Positive implements Zend_Filter_Interface {
	
	public function filter($value) {
		
		$clean = $value;
		
		if ($value < 0) {
			
			$clean = $value * -1;
			
		}
		
		return $clean;
		
	}
	
}