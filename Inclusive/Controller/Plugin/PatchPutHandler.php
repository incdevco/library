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
        if (!$request instanceof Zend_Controller_Request_Http) {
            return;
        }

        if ($this->_request->getMethod() == 'PUT' || $this->_request->getMethod() == 'PATCH') {
            $putParams = array();
            parse_str($this->_request->getRawBody(), $putParams);
            $request->setParams($putParams);
        }
    }
}
