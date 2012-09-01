<?php

class Inclusive_Validate_RequiredIfEmpty
	extends Zend_Validate_Abstract
{

	protected $_key = null;
	
	protected $_messageTemplates = array(
		'required'=>'This field is required.'
		);

	public function __construct($key)
	{
	
		$this->_key = $key;
	
	}

	public function isValid($value,$context=null)
	{
	
		if (!empty($value)) {
		
			return true;
			
		}
		
		if (isset($context[$this->_key])
			&& !empty($context[$this->_key])) {
		
			return true;
		
		}
		
		$this->_error('required');
		return false;
	
	}

}