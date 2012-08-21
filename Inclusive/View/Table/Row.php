<?php

class Inclusive_View_Table_Row 
{
	
	protected $_data = null;
	
	protected $_columns = array();
	
	protected $_table = null;
	
	protected $_type = 'row';
	
	protected $_options = null;
	
	public function __construct(
		array $data,
		array $options=null,
		Inclusive_View_Table $table=null
	) 
	{
		
		$this->_data = $data;
		
		foreach ($this->_data as $key => $value)
		{
		
			if (!$value instanceof Inclusive_View_Table_Column)
			{
			
				$value = new Inclusive_View_Table_Column($key,$value);
			
			}
		
			$this->_columns[] = $value;
		
		}
		
		$this->_options = $options;
		
		$this->_table = $table;
		
	}
	
	public function getColumns()
	{
	
		return $this->_columns;
	
	}
	
	public function getFields() 
	{
		
		$fields = array_keys($this->_data);
		
		if ($this->getOption('navigation')) 
		{
			
			$fields[] = '&nbsp;';
			
		}
		
		return $fields;
		
	}
	
	public function getOption($option) 
	{
		
		if (!isset($this->_options[$option])) 
		{
			
			return null;
			
		}
		
		return $this->_options[$option];
		
	}
	
	public function getTable()
	{
	
		return $this->_table;
	
	}
	
	public function getValue($field) 
	{
		
		if ($field == '&nbsp;') 
		{
			
			return $this->getOption('navigation');
			
		}
		
		return $this->_data[$field];
		
	}
	
	public function setTable(Inclusive_View_Table $table)
	{
	
		$this->_table = $table;
		
		return $this;
	
	}
	
}