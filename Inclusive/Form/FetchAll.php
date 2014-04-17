<?php

class Inclusive_Form_FetchAll extends Inclusive_Form
{
	
	public function __construct($options=null)
	{
	
		parent::__construct($options);
		
		$this->_ifEmptyUnset[] = 'limit';
		$this->_ifEmptyUnset[] = 'offset';
		
		$this
			->addElement(new Inclusive_Form_Element_Hidden('limit'))
			->addElement(new Inclusive_Form_Element_Hidden('offset'));
		
	}
	
}