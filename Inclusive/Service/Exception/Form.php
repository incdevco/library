<?php

class Inclusive_Service_Exception_Form 
	extends Inclusive_Service_Exception 
{
	
	protected $_form = null;
	
	public function __construct(
		$msg='',
		$code=0,
		Exception $previous=null
	) 
	{
	
		if ($msg instanceof Zend_Form)
		{
		
			$this->setForm($msg);
			
			$msg = get_class($msg).' is Invalid. ';
			
			foreach ($this->getForm()->getElements() as $element)
			{
			
				$msg .= print_r($element->getErrorMessages(),true);
			
			}	
		
		}
	
		parent::__construct($msg,$code,$previous);
	
	}
	
	public function getForm() {
	
		return $this->_form;
		
	}
	
	public function setForm(Zend_Form $form) {
	
		$this->_form = $form;
		
		return $this;
	
	}	
	
}