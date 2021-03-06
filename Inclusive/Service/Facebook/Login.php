<?php

class Inclusive_Service_Facebook_Login extends Inclusive_Service_Abstract
{

	protected $_adapterClass = 'Inclusive_Service_Facebook_Login_Adapter';
	
	protected $_formClasses = array(
		'Login'=>'Inclusive_Form_Facebook_Login'
		);
	
	public function login(array $data)
	{
	
		$form = $this->getForm('Login');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			return $this->getAdapter()
				->login($clean);
		
		}
		
		return $this->_throwForm($form);
	
	}

}