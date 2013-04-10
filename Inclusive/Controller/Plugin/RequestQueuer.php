<?php

class Inclusive_Controller_Plugin_RequestQueuer extends Zend_Controller_Plugin_Abstract
{
	
	protected $_queueClass = 'Zend_Queue';
	
	public function getQueue()
	{
		
		if (null === $this->_queue)
		{
			
			$class = $this->_queueClass;
			
			$this->_queue = new $class('Array');
		
		}
		
		return $this->_queue;
		
	}
	
	public function isQueueable(Zend_Controller_Request_Abstract $request)
	{
	
		return true;
	
	}
	
	public function queue(Zend_Controller_Request_Abstract $request)
	{
		
		$this->getQueue()->send($request);
	
	}
	
	public function routeShutdown(Zend_Controller_Request_Abstract $request)
	{
	
		if ($this->isQueueable($request))
		{
		
			$this->queue($request);
			
			$this->getResponse()
				->setBody($request->getHeader('INCLUSIVE_REQUEST_ID'))
				->sendResponse();
			exit;
		
		}
		
	}
	
}