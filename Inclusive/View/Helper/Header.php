<?php

class Inclusive_View_Helper_Header extends Zend_View_Helper_Abstract {

	public function header($content,$number=1,$class='') {
	
		$string = '<h'.$number.' class="'.$class.'">'.$content.'</h'.$number.'>';
		
		return $string;
	
	}

}