<?php

class Inclusive_Form_Paypal_ExpressCheckout_Element_Name extends Inclusive_Form_Element_Text
{

	public function __construct($spec='name',$options=null)
	{
	
		if (!isset($options['required']))
		{
	
			$options['required'] = true;
	
		}
	
		if (!isset($options['label']))
		{
	
			$options['label'] = 'Name';
	
		}
	
		parent::__construct($spec,$options);
	
	}

}