<?php

class Inclusive_Set_Abstract {

	protected $_data = null;
	
	public function __construct(array $data) {
	
		$this->_data = $data;
	
	}
	
	public function toViewTable() {
	
		return 'Test';
	
	}

}