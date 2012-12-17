<?php

class Inclusive_Acl_Resource_ControllerRequest implements Zend_Acl_Resource_Interface
{

	protected $_request = null;

	public function __construct(Zend_Controller_Request_Abstract $request)
	{
	
		$this->_request = $request;
	
	}
	
	public function getResourceId()
	{
	
		$string = '';
		
		$string .= $this->_request->getModuleName();
		
		$string .= ':';
		
		$string .= $this->_request->getControllerName();
		
		return $string;
	
	}

}