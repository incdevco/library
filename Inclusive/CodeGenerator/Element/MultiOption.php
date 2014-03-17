<?php

class Inclusive_CodeGenerator_Element_MultiOption
{
	
	protected $_label = null;
	
	protected $_key = null;
	
	public function getLabel()
	{
	
		return $this->_label;
	
	}
	
	public function getKey()
	{
	
		return $this->_key;
	
	}
	
	public function setLabel($label)
	{
	
		$this->_label = $label;
		
		return $this;
	
	}
	
	public function setKey($key)
	{
	
		$this->_key = $key;
		
		return $this;
	
	}
	
}