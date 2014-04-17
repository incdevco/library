<?php

class Inclusive_Service_Exception_NotAllowed extends Inclusive_Service_Exception 
{
	
	public function __construct($resource,$privilege) 
	{
	
		$msg = 'Not Allowed ('.$privilege.') on ('.$resource->getResourceId().')';
	
		parent::__construct($msg);
	
	}
	
}