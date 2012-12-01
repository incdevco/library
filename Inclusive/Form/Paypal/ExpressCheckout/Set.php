<?php

class Inclusive_Form_Paypal_ExpressCheckout_Set extends Inclusive_Form 
{

	public function init()
	{
	
		$this
			->addElement(new Inclusive_Form_Paypal_ExpressCheckout_Element_Name())
			->addElement(new Inclusive_Form_Paypal_ExpressCheckout_Element_Amount())
			->addElement(new Inclusive_Form_Paypal_ExpressCheckout_Element_Url('return_url'))
			->addElement(new Inclusive_Form_Paypal_ExpressCheckout_Element_Url('cancel_url'));
	
	}
	
}