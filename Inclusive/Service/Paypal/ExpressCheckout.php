<?php

class Inclusive_Service_Paypal_ExpressCheckout extends Inclusive_Service_Abstract
{

	protected $_adapterClass = 'Inclusive_Service_Paypal_ExpressCheckout_Adapter';

	protected $_formClasses = array(
		'Do'=>'Inclusive_Form_Paypal_ExpressCheckout_Do',
		'Get'=>'Inclusive_Form_Paypal_ExpressCheckout_Get',
		'Set'=>'Inclusive_Form_Paypal_ExpressCheckout_Set'
		);

	public function ddo(array $data)
	{
	
		$form = $this->getForm('Do');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			return $this->getAdapter()
				->ddo($clean);
		
		}
		
		return $this->_throwForm($form);
	
	}

	public function get(array $data)
	{
	
		$form = $this->getForm('Get');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			return $this->getAdapter()
				->get($clean);
		
		}
		
		return $this->_throwForm($form);
	
	}

	public function set(array $data)
	{
	
		$form = $this->getForm('Set');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			return $this->getAdapter()
				->set($clean);
		
		}
		
		return $this->_throwForm($form);
	
	}

}