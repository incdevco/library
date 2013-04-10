<?php

class Inclusive_Application_Resource_RequestCollector extends Zend_Application_Resource_Resource
{

	public function init()
	{
	
		$this->getBootstrap()->bootstrap('FrontController');
		
		$front = $this->getBootstrap()->getResource('FrontController');
		
		$requestCollector = new Inclusive_Controller_Plugin_RequestCollector();
		
		$front->registerPlugin($requestCollector);
		
		return $requestCollector;
		
	}
	
}