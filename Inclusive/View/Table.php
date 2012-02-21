<?php 

class Inclusive_View_Table {

	protected $_rows = array();

	public function addRow(array $columns,$options=null) {
	
		$this->_rows[] = new Inclusive_Table_Row($columns,$options);
		
		return $this;
	
	}
	
	public function count() {
	
		return count($this->_rows);
	
	}
	
	public function getFirstRow() {
	
		if (!$this->count()) {
		
			return false;
		
		}
	
		return $this->_rows[0];
	
	}
	
	public function getRows() {
	
		return $this->_rows;
		
	}

}