<?php

class Inclusive_View_Table_Column 
{

	protected $_key = null;
	
	protected $_value = null;
	
	protected $_options = null;

	public function __construct($key,$value='&nbsp;',$options=null)
	{
	
		$this->_key = $key;
		
		$this->_value = $value;
		
		$this->_options = $options;
	
	}
	
	public function getKey()
	{
	
		return $this->_key;
		
	}
	
	public function getOption($key)
	{
	
		if (!isset($this->_options[$key]))
		{
		
			return null;
			
		}
	
		return $this->_options[$key];
	
	}
	
	public function getOptions()
	{
	
		return $this->_options;
	
	}
	
	public function getValue()
	{
	
		return $this->_value;
	
	}

}