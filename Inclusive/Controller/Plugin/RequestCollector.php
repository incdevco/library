<?php

class Inclusive_Controller_Plugin_RequestCollector extends Zend_Controller_Plugin_Abstract implements Inclusive_Service_ServicableInterface
{
	
	protected $_headerName = 'INCLUSIVE_REQUEST_ID';
	
	protected $_serviceClasses = array(
		'Request'=>'Application_Service_Request'
		);
	
	public function dispatchLoopShutdown()
	{
		
		$header = $this->getHeaderName();
		
		$request = $this->getRequest();
		$response = $this->getResponse();
		
		$this->getService('Request')
			->setResponse(array(
				'id'=>$request->getHeader($header),
				'response'=>$this->getResponse()
				));
	
	}
	
	public function getHeaderName()
	{
	
		return $this->_headerName;
		
	}
	
	public function routeStartup(Zend_Controller_Request_Abstract $request)
	{
		
		$header = $this->getHeaderName();
		
		if ($request->hasHeader($header))
		{
		
			$id = $request->getHeader($header);
		
		}
		else 
		{
			
			$id = $this->getService('Request')
				->add($request);
			
			$request->setHeader($header,$id,true);
		
		}
				
	}
	
}