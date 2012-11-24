<?php 

class Inclusive_View_Table 
{

	protected $_rows = array();

	protected $_options = array();

	public function __construct($options=null)
	{
	
		if ($options !== null)
		{
		
			$this->setOptions($options);
		
		}
	
	}

	public function addRow($row,$options=null) 
	{
	
		if (is_array($row))
		{
		
			$row = new Inclusive_View_Table_Row($row,$options,$this);
		
		}
		elseif ($row instanceof Inclusive_View_Table)
		{
		
			
		
		}
		elseif ($row instanceof Inclusive_View_Table_Row)
		{
		
			$row->setTable($this);
		
		}
		else 
		{
		
			throw new Inclusive_View_Table_Exception('Not A Valid Row');
		
		}
	
		$this->_rows[] = $row;
		
		return $this;
	
	}
	
	public function count() 
	{
	
		return count($this->_rows);
	
	}
	
	public function getClass()
	{
	
		$class = 'inclusive_table';
	
		if (isset($this->_options['class']))
		{
		
			$class = $this->_options['class'];
		
		}
		
		return $class;
		
	}
	
	public function getFirstRow() 
	{
	
		if (!$this->count()) {
		
			return false;
		
		}
	
		return $this->_rows[0];
	
	}
	
	public function getOptions()
	{
	
		return $this->_options;
	
	}
	
	public function getRows() 
	{
	
		return $this->_rows;
		
	}
	
	public function setOptions($options)
	{
	
		if (is_array($options))
		{
		
			$this->_options = $options;
		
		}
		
		return $this;
	
	}

}