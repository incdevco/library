<?php

class Inclusive_Controller_Plugin_CSRF_ThreatException extends Inclusive_Exception
{

	public function __construct($msg='Possible CSRF Threat',$code=0,Exception $previous=null)
	{
	
		parent::__construct($msg,$code,$previous);
	
	}

}