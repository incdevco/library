<?php

class Inclusive_Form_Google_Checkout_Notification_SerialNumber extends Inclusive_Form
{

	public function init()
	{
	
		$this->addElement(new Inclusive_Form_Element_Hidden('serial_number',array(
				'required'=>true
				)));
	
	}
	
}