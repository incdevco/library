<?php 

class Inclusive_View_Table 
{

	protected $_rows = array();

	public function addRow($row,$options=null) 
	{
	
		if (is_array($row))
		{
		
			$row = new Inclusive_View_Table_Row($row,$options,$this);
		
		}
	
		if ($row instanceof Inclusive_View_Table_Row)
		{
		
			$row->setTable($this);
		
		}
		else 
		{
		
			throw new Inclusive_View_Table_Exception('Must be an array or Inclusive_View_Table_Row');
		
		}
	
		$this->_rows[] = $row;
		
		return $this;
	
	}
	
	public function count() 
	{
	
		return count($this->_rows);
	
	}
	
	public function getFirstRow() 
	{
	
		if (!$this->count()) {
		
			return false;
		
		}
	
		return $this->_rows[0];
	
	}
	
	public function getRows() 
	{
	
		return $this->_rows;
		
	}

}