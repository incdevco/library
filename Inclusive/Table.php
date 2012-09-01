<?php 

class Inclusive_Table {

	protected $_rows = array();

	public function addRow($row,$options=null) {
	
		if ($row instanceof Inclusive_Table_Row) {
		
			$this->_rows[] = $row;
		
		} elseif (is_array($row)) {
		
			$this->_rows[] = new Inclusive_Table_Row($row,$options);
			
		}
	
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