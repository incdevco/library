<?php

class Inclusive_View_Helper_Header extends Zend_View_Helper_Abstract {

	public function header($content,$number=1) {
	
		$string = '<h'.$number.'>'.$content.'</h'.$number.'>';
		
		return $string;
	
	}

}