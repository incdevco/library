<?php

class Inclusive_View_Helper_MenuNavigation extends Zend_View_Helper_Abstract {

	protected $_navigation = null;

	public function menuNavigation() {
	
		if (!($this->_navigation instanceof Zend_Navigation)) {
		
			$this->_navigation = new Zend_Navigation(array());
			
		}
		
		return $this->_navigation;
	
	}

}