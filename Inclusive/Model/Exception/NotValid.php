<?php

class Inclusive_Model_Exception_NotValid extends Inclusive_Model_Exception
{

	public function __construct($model,$form)
	{
	
		$message = 'Not Valid ('.print_r($form->getMessages(),true).') On ('.$model->getResourceId().')'.print_r($model->getDirty(),true);
		
		parent::__construct($message);
	
	}

}