<?php

class Inclusive_Model_Exception_NotAllowed extends Inclusive_Model_Exception
{

	public function __construct($model,$transformer)
	{
	
		$message = 'Not Allowed To ('.get_class($transformer).') On ('.$model->getResourceId().')';
		
		parent::__construct($message);
	
	}

}