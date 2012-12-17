<?php

class Inclusive_Form_Element_CSRF extends Zend_Form_Element_Hash
{

	public function __construct($spec='inclusive_csrf',$options=null)
	{
	
		parent::__construct($spec,$options);
		
		$this->getValidator('Identical')
			->setMessage('Please resubmit the form.','notSame')
			->setMessage('Please resubmit the form.','missingToken');
			
		$this->removeDecorator('HtmlTag');
		$this->removeDecorator('Label');
		
	}

}