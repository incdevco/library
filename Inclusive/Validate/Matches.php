<?php

class Inclusive_Validate_Matches extends Zend_Validate_Abstract
{

	protected $_elementToMatch = null;

	protected $_messageTemplates = array(
		'noElement'=>'Element To Match Does Not Exist',
		'noMatch'=>'Does not match %value%'
		);
	
	public function __construct($elementToMatch,$options=null)
	{
	
		$this->_elementToMatch = $elementToMatch;
		
		if (isset($options['obscureValue']))
		{
		
			$this->_obscureValue = $options['obscureValue'];
		
		}
		
	}
	
	public function isValid($value,$context=null)
	{
	
		if (!isset($context[$this->_elementToMatch]))
		{
		
			$this->_error('noElement',$this->_elementToMatch);
			return false;
		
		}
	
		if ($value == $context[$this->_elementToMatch])
		{
		
			return true;
		
		}
		
		$this->_error('noMatch');
		return false;
	
	}
	
}