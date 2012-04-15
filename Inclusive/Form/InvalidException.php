<?php

class Inclusive_Form_InvalidException 
	extends Zend_Exception {
	
	protected $_form = null;
	
	public function __construct(
		Zend_Form $form,
		$message=null,
		$code=0,
		Exception $previous=null
		) {
		
		$this->_form = $form;
		
		parent::__construct($message,$code,$previous);
		
	}
	
}