<?php

class Inclusive_Form extends Zend_Form 
{
	
	protected $_attribs = array(
		'class'=>'inclusive'
		);
	
	protected $_ifEmptyUnset = array();
	
	protected $_ifEmptySetNull = array();
	
	public function __construct($options=null)
	{
	
		parent::__construct($options);
		
	}
	
	public function getValues($suppressArrayNotation=false)
	{
	
		$values = parent::getValues($suppressArrayNotation);
		
		foreach ($this->_ifEmptyUnset as $key)
		{
		
			if ($this->isValueEmpty($values[$key]))
			{
			
				unset($values[$key]);
			
			}
		
		}
		
		foreach ($this->_ifEmptySetNull as $key)
		{
		
			if ($this->isValueEmpty($values[$key]))
			{
			
				$values[$key] = null;
			
			}
		
		}
		
		return $values;
	
	}
	
	public function isValueEmpty($value)
	{
	
		if (null === $value || '' == $value)
		{
		
			return true;
		
		}

		return false;
	
	}
	
}
