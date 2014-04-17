<?php

class Inclusive_Model_Exception_NotAllowed extends Inclusive_Model_Exception
{

	public function __construct($model,$privilege)
	{
	
		$message = 'Not Allowed To ('.$privilege.') On ('.$model->getResourceId().')';
		
		parent::__construct($message);
	
	}

}