<?php

class Inclusive_Application_Resource_RequestQueue extends Zend_Application_Resource_Resource
{

	public function init()
	{
	
		$this->getBootstrap()->bootstrap('FrontController');
		
		$front = $this->getBootstrap()->getResource('FrontController');
		
		$requestQueue = new Inclusive_Application_RequestQueue($this->getOptions());
		
		$front->registerPlugin(new Inclusive_Controller_Plugin_RequestQueuer($requestQueue));
		
		return $requestQueue;
		
	}
	
}