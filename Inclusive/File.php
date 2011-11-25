<?php

class Inclusive_File {
	
	protected $_file = null;
	
	public function __construct($file) {
		
		if (!is_file($file)) {
			
			throw new Zend_Exception($file.' is not a file.');
			
		}
		
		$this->_file = $file;
		
	}
	
	public function getFullName() {
		
		return $this->_file;
		
	}
	
	public function getName() {
		
		return basename($this->_file);
		
	}
	
	public function getContents() {
		
		return file_get_contents($this->_file);
		
	}
	
}