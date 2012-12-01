<?php

class Inclusive_Service_Google_Checkout_Notification extends Inclusive_Service_Abstract
{

	protected $_adapterClass = 'Inclusive_Service_Google_Notification_Adapter';

	protected $_formClasses = array(
		'SerialNumber'=>'Inclusive_Form_Google_Notification_SerialNumber'
		);
		
	protected $_modelClass = 'Inclusive_Model_Google_Checkout_Notification';
	
	protected $_setClass = 'Inclusive_Set_Google_Checkout_Notification';

	public function serialNumber(array $data)
	{
	
		if (isset($data['serial-number']))
		{
	
			$data['serial_number'] = $data['serial-number'];
		
		}
	
		$form = $this->getForm('SerialNumber');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			return $this->getAdapter()
				->serialNumber($clean);
		
		}
		
		return $this->_throwForm($form);
	
	}

}