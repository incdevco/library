<?php

class Inclusive_Form_Element_Hidden 
	extends Zend_Form_Element_Hidden 
{
	
	public function __construct($spec,$options=null)
	{
	
		parent::__construct($spec,$options);
		
		$this
			->removeDecorator('HtmlTag')
			->removeDecorator('Label');
	
	}
	
}
