<?php

class Inclusive_Form_Paypal_ExpressCheckout_Get extends Inclusive_Form 
{

	public function init()
	{
	
		$this->addElement(new Inclusive_Form_Paypal_ExpressCheckout_Element_Token());
	
	}

}