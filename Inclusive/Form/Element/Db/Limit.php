<?php

class Inclusive_Form_Element_Db_Limit extends Inclusive_Form_Element_Text
{

	protected $_defaultLimit = 100;

	public function __construct($spec='limit',$options=null)
	{
	
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
		
		if (!isset($options['label']))
		{
		
			$options['label'] = 'Limit';
		
		}
		
		parent::__construct($spec,$options);
	
	}

}