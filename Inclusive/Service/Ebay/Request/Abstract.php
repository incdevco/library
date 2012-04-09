<?php

abstract class Inclusive_Service_Ebay_Request_Abstract {
	
	protected $_ErrorHandling = 'BestEffort';
	
	protected $_ErrorLanguage = 'en_US';
	
	protected $_MessageID = null;
	
	protected $_Version = 765;
	
	protected $_WarningLevel = 'High';
	
	protected $_eBayAuthToken = null;
	
	
	abstract public function toXml();
	
	abstract public function getResponse($response);
	
	
	public function getErrorHandling() {
	
		return $this->_ErrorHandling;
		
	}
	
	public function setErrorHandling($value) {
	
		$this->_ErrorHandling = $value;
		
		return $this;
		
	}
	
	public function getErrorLanguage() {
	
		return $this->_ErrorLanguage;
		
	}
	
	public function setErrorLanguage($value) {
	
		$this->_ErrorLanguage = $value;
		
		return $this;
		
	}
	
	public function getMessageID() {
	
		return $this->_MessageID;
		
	}
	
	public function setMessageID($value) {
	
		$this->_MessageID = $value;
		
		return $this;
		
	}
	
	public function getVersion() {
	
		return $this->_Version;
		
	}
	
	public function setVersion($value) {
	
		$this->_Version = $value;
		
		return $this;
		
	}
	
	public function getWarningLevel() {
	
		return $this->_WarningLevel;
		
	}
	
	public function setWarningLevel($value) {
	
		$this->_WarningLevel = $value;
		
		return $this;
		
	}
	
	public function geteBayAuthToken() {
	
		return $this->_eBayAuthToken;
	
	}
	
	public function seteBayAuthToken($token) {
	
		$this->_eBayAuthToken = $token;
		
		return $this;
	
	}
	
	// 
	
	protected function _renderXml() {
	
		return '<?xml version="1.0" encoding="utf-8"?>';
		
	}
	
	protected function _renderErrorHandling() {
	
		return $this->_renderValue('ErrorHandling');
	
	}
	
	protected function _renderErrorLanguage() {
	
		return $this->_renderValue('ErrorLanguage');
	
	}
	
	protected function _renderMessageID() {
	
		return $this->_renderValue('MessageID');
	
	}
	
	protected function _renderVersion() {
	
		return $this->_renderValue('Version');
	
	}
	
	protected function _renderWarningLevel() {
	
		return $this->_renderValue('WarningLevel');
	
	}
	
	protected function _rendereBayAuthToken() {
	
		$string = '<RequesterCredentials>';
		
		$string .= $this->_renderValue('eBayAuthToken');
		
		$string .= '</RequesterCredentials>';
		
		return $string;
	
	}
	
	// render functions
	
	protected function _createKey($name,$prefix='') {
	
		return $prefix.'_'.$name;
		
	}
	
	protected function _isArrayAssociative(array $array) {
	
		return array_keys($array) !== range(0,count($array) - 1);
	
	}
	
	protected function _shouldRenderArray($name,$prefix='') {
	
		$key = $this->_createKey($name,$prefix);
	
		if (!empty($this->$key)) {
		
			return true;
			
		}
		
		return false;
	
	}
	
	protected function _renderArray($name,$prefix='') {
	
		$arrayKey = $this->_createKey($name,$prefix);
	
		$arrayName = $name;
	
		$arrayValue = $this->$arrayKey;
	
		$string = '';
	
		if ($this->_isArrayAssociative($arrayValue)) {
		
			$string .= '<'.$arrayName.'>';
		
			foreach ($arrayValue as $name => $value) {
			
				if (!is_int($name)) {
				
					if ($value !== null) {
						
						$string .= '<'.$name.'>';
												
						$string .= $value;
						
						$string .= '</'.$name.'>';
					
					}
					
				} else {
				
					foreach ($value as $v) {
					
						$string .= '<'.$name.'>';
						
						$string .= $v;
					
						$string .= '</'.$name.'>';
					
					}
				
				}
			
			}
			
			$string .= '</'.$arrayName.'>';
		
		} else {
		
			foreach ($arrayValue as $value) {
			
				$string .= '<'.$arrayName.'>';
				
				$string .= $value;
			
				$string .= '</'.$arrayName.'>';
			
			}
		
		}
		
		return $string;
	
	}
	
	protected function _shouldRenderValue($name,$prefix='') {
	
		$key = $this->_createKey($name,$prefix);
		
		if ($this->$key !== null) {
		
			return true;
			
		}
		
		return false;
	
	}
	
	protected function _renderValue($name,$prefix='') {
	
		$string = '<'.$name.'>';
	
		$key = $this->_createKey($name,$prefix);
	
		$value = $this->$key;
		
		if (is_bool($value)) {
		
			if ($value) {
		
				$string .= '1';
			
			} else {
			
				$string .= '0';
			
			}
			
		} else {
		
			$string .= $value;
		
		}
		
		$string .= '</'.$name.'>';
		
		return $string;
	
	}
	
}