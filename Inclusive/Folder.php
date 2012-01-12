<?php

class Inclusive_Folder {
	
	protected $_folder = null;
	
	protected $_ignore = array(
		'.',
		'..'
		);
		
	protected $_options = null;
	
	public function __construct($folder,array $options=null) {
		
		$this->_folder = $folder;
		
		if (isset($options['baseName'])) {
			
			$folder = $options['baseName'].$folder;
			
		}
		
		if (!is_dir($folder)) {
			
			throw new Zend_Exception($folder.' is not a folder.');
			
		}
		
		$this->_options = $options;
		
	}
	
	public function getFullName() {
		
		if (isset($this->_options['baseName'])) {
			
			return $this->_options['baseName'].$this->_folder;
			
		}
		
		return $this->_folder;
		
	}
	
	public function getName() {
		
		return basename($this->_folder);
		
	}
	
	public function getContents() {
		
		$handler = opendir($this->getFullName());
		
		$contents = array();
		
		while (($content = readdir($handler))) {
			
			if (!in_array($content,$this->_ignore)) {
				
				$fullName = $this->getFullName().'/'.$content;
				
				if (is_dir($fullName)) {
					
					$contents[] = new Inclusive_Folder($content,array_merge($this->_options,array('baseName'=>$this->getFullName().'/')));
					
				} else {
					
					$contents[] = new Inclusive_File($fullName,$this->_options);
					
				}
				
			}
			
		}
		
		return $contents;
		
	}
	
}