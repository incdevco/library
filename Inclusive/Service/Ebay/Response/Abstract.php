<?php

abstract class Inclusive_Service_Ebay_Response_Abstract {
	
	protected $_response = null;
	
	protected $_xml = null;
	
	public function __construct($response) {
	
		$this->_response = $response;
	
	}
	
	public function getResponse() {
	
		return $this->_response;
	
	}
	
	public function getXml() {
	
		if (!($this->_xml instanceof Zend_Config_Xml)) {
		
			$this->_xml = new Zend_Config_Xml($this->getResponse());
		
		}
		
		return $this->_xml;
	
	}
	
	public function isSuccess() {
	
		$xml = $this->getXml();
		
		if ($xml->Ack == 'Success') {
		
			return true;
			
		}
		
		return false;
	
	}
	
}