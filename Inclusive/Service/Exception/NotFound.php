<?php

class Inclusive_Service_Exception_NotFound extends Inclusive_Service_Exception 
{
	
	public function __construct() 
	{
	
		$msg = 'No Resource Found';
	
		parent::__construct($msg);
	
	}
	
}