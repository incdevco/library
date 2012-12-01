<?php

class Inclusive_Form_Paypal_ExpressCheckout_Element_PayerId extends Inclusive_Form_Element_Hidden
{

	public function __construct($spec='PayerID',$options=null)
	{
	
		if (!isset($options['required']))
		{
	
			$options['required'] = true;
	
		}
	
		parent::__construct($spec,$options);
	
	}

}