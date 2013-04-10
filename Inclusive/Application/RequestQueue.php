<?php

class Inclusive_Application_RequestQueue extends Zend_Queue
{

	public function send($message)
	{
	
		if ($message instanceof Zend_Controller_Request_Abstract)
		{
		
			$request = $message;
			
			$message = $request->getRawBody();
		
		}
		
		return parent::send($message);
	
	}

}