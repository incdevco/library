<?php

class Inclusive_View_Table_Row {
	
	protected $_data = null;
	
	protected $_options = null;
	
	public function __construct(array $data,array $options=null) {
		
		$this->_data = $data;
		
		$this->_options = $options;
		
	}
	
	public function getFields() {
		
		$fields = array_keys($this->_data);
		
		if ($this->getOption('navigation')) {
			
			$fields[] = '&nbsp;';
			
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
		
		if ($field == '&nbsp;') {
			
			return $this->getOption('navigation');
			
		}
		
		return $this->_data[$field];
		
	}
	
}