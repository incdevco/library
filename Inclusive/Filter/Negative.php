<?php

class Inclusive_Filter_Negative implements Zend_Filter_Interface {
	
	public function filter($value) {
		
		if ($value > 0) {
			
			$clean = $value * -1;
			
		} else {
			
			$clean = $value;
			
		}
		
		return $clean;
		
	}
	
}