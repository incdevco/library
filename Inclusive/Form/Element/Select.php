<?php

class Inclusive_Form_Element_Select extends Zend_Form_Element_Select
{
	
	protected $_defaultMultiOptions = array();
	
    public function __construct($spec,$options=null)
    {
    	
    	if (!isset($options['multiOptions']))
    	{
    	
    		$options['multiOptions'] = $this->_defaultMultiOptions;
    	
    	}
    	
    	parent::__construct($spec,$options);
    
    }

}