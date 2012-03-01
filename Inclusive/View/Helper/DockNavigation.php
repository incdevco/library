<?php

class Inclusive_View_Helper_DockNavigation extends Zend_View_Helper_Abstract {

	protected $_navigation = null;

	public function dockNavigation() {
	
		if (!($this->_navigation instanceof Zend_Navigation)) {
		
			$this->_navigation = new Zend_Navigation(array());
			
		}
		
		return $this->_navigation;
	
	}

}