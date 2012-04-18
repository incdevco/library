<?php

abstract class Inclusive_Model_Abstract {

	protected $_data = array();
	
	protected $_new = array();

	protected $_service = null;
	
	public function __construct(
		Inclusive_Service_Abstract $service,
		array $data=array()
		) {
		
		$this->setService($service);
	
		$this->_data = $data;
	
	}
	
	public function getService() {
	
		return $this->_service;
	
	}
	
	public function save() {
	
		if ($this->_isNew()) {
		
			$this->getService()
				->add($this->_data);
		
		} else {
		
			$this->getService()
				->edit($this->_data);
		
		}
		
		return $this;
	
	}
	
	public function set($key,$value) {
	
		$this->_new[$key] = $value;
		
		return $this;
	
	}
	
	public function setFromArray(array $data) {
	
		foreach ($data as $key => $value) {
		
			$this->set($key,$value);
		
		}
		
		return $this;
	
	}
	
	public function setService(
		Inclusive_Service_Abstract $service
		) {
	
		$this->_service = $service;
		
		return $this;
	
	}
	
	public function toArray() {
	
		return array_merge($this->_data,$this->_new);
	
	}
	
	protected function _isNew() {
	
		if (empty($this->_data)) {
		
			return true;
			
		}
		
		return false;
	
	}
	
	public function __get($key) {
	
		$array = $this->toArray();
		
		if (!isset($array[$key])) {
		
			return null;
		
		}
		
		return $array[$key];
	
	}

}