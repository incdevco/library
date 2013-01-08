<?php

class Inclusive_Form_Element_Db_Offset extends Inclusive_Form_Element_Hidden
{

	protected $_defaultOffset = 0;

	public function __construct($spec='offset',$options=null)
	{
	
		if (!isset($options['validators']))
		{
		
			$options['validators'] = array(
				'Digits'
				);
		
		}
		
		if (!isset($options['value']))
		{
		
			$options['value'] = $this->_defaultOffset;
		
		}
		
		parent::__construct($spec,$options);
	
	}

}