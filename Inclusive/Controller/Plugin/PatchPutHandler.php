<?php

class Inclusive_Controller_Plugin_PatchPutHandler extends Zend_Controller_Plugin_Abstract
{
    /**
     * Before dispatching, digest PATCH/PUT request body and set params
     *
     * @param Zend_Controller_Request_Abstract $request
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if (!$request instanceof Zend_Controller_Request_Http) 
        {
            return;
        }

        if ($this->_request->getMethod() == 'PUT' 
        	|| $this->_request->getMethod() == 'PATCH' 
        	|| $this->_request->getMethod() == 'POST') 
        {
            $putParams = array();
            $header = $this->_request->getHeader('Content-Type');
            if ($header && preg_match('#json#',$header))
            {
            
            	$putParams = Zend_Json::decode($this->_request->getRawBody());	
            
            }
            else 
            {
            	
            	parse_str($this->_request->getRawBody(), $putParams);
            	
            }
            
            $request->setParams($putParams);
        }
    }
}
