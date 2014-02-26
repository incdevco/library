<?php

class Inclusive_Service_Exception_NotAllowed extends Inclusive_Service_Exception 
{
	
	public function __construct($resource,$privilege) 
	{
		
		$id = $resource->getResourceId();
		
		$msg = 'Not Allowed to '.$privilege.' on '.$id;
	
		parent::__construct($msg,0,null);
	
	}
	
}