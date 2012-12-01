<?php

class Inclusive_Form_Element_HtmlEditor extends Zend_Form_Element_Textarea {

	public $helper = 'htmlEditor';

	public function __contruct($spec,$options=null) 
	{
	
		parent::__contruct($spec,$options);
		
		if (!$this->getFilter('Inclusive_Filter_HtmlPurifier')) 
		{
		
			$this->addFilter(new Inclusive_Filter_HtmlPurifier());
		
		}
		
	}

}