<?php

class Inclusive_Form_Paypal_ExpressCheckout_Element_OrderTotal extends Inclusive_Form_Element_Hidden
{

	public function __construct($spec='order_total',$options=null)
	{
	
		if (!isset($options['required']))
		{
	
			$options['required'] = true;
	
		}
	
		parent::__construct($spec,$options);
	
	}

}