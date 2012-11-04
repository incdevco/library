<?php

class Inclusive_Form_Paypal_ExpressCheckout_Element_Amount extends Inclusive_Form_Element_Money 
{
	
	public function __construct($spec='amount',$options=null)
	{
	
		if (!isset($options['required']))
		{
		
			$options['required'] = true;
			
		}
		
		if (!isset($options['label']))
		{
		
			$options['label'] = 'Amount';
			
		}
				
		parent::__construct($spec,$options);
	
	}
	
}