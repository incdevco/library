<?php

class Inclusive_Form_Element_Db_Limit extends Inclusive_Form_Element_Text
{

	protected $_defaultLimit = 100;

	public function __construct($spec='limit',$options=null)
	{
	
		if (!isset($options['required']))
		{
		
			$options['required'] = true;
		
		}
	
		if (!isset($options['validators']))
		{
		
			$options['validators'] = array(
				'Digits'
				);
		
		}
	
		if (!isset($options['value']))
		{
		
			$options['value'] = $this->_defaultLimit;
		
		}
	
		parent::__construct($spec,$options);
	
	}

}