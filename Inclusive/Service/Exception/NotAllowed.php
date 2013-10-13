<?php

class Inclusive_Service_Exception_NotAllowed extends Inclusive_Service_Exception 
{
	
	public function __construct($resource,$privilege,$context) 
	{
		
		$id = $resource->getResourceId();
		
		$msg = 'Not Allowed to '.$privilege.' on '.$id.' with '.print_r($context,true);
	
		parent::__construct($msg,0,null);
	
	}
	
}