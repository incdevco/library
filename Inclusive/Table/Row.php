<?php

class Inclusive_Table_Row {
	
	protected $_data = null;
	
	protected $_options = null;
	
	public function __construct(array $data,array $options=null) {
		
		$this->_data = $data;
		
		$this->_options = $options;
		
	}
	
	public function getFields() {
		
		$fields = array_keys($this->_data);
		
		if ($this->getOption('navigation')) {
			
			$fields[] = 'Navigation';
			
		}
		
		return $fields;
		
	}
	
	public function getOption($option) {
		
		if (!isset($this->_options[$option])) {
			
			return null;
			
		}
		
		return $this->_options[$option];
		
	}
	
	public function getValue($field) {
		
		if ($field == 'Navigation') {
			
			return $this->getOption(strtolower($field));
			
		}
		
		return $this->_data[$field];
		
	}
	
}