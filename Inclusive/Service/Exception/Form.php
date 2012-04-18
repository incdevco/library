<?php

class Inclusive_Service_Exception_Form
	extends Zend_Exception {
	
	protected $_form = null;
	
	public function __construct($form) {
	
		$this->_form = $form;
	
		parent::__construct('Form Invalid');
	
	}
	
	public function getForm() {
	
		return $this->_form;
		
	}
	
	public function setForm(Inclusive_Form $form) {
	
		$this->_form = $form;
		
		return $this;
	
	}	
	
}