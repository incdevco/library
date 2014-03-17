<?php

class Inclusive_CodeGenerator_Class_Variable
{
	protected $_default = null;
	
	protected $_name = null;
	
	protected $_visibility = 'private';
	
	public function generate()
	{
		
		$string = "\t".$this->getVisibility().' ';
		
		$string .= '$'.$this->getName();
		
		$string .= ' = '.$this->getDefault().';';
		
		return $string;
	
	}
	
	public function getDefault()
	{
	
		return $this->_default;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function getVisibility()
	{
	
		return $this->_visibility;
	
	}
	
	public function setDefault($default)
	{
		
		$this->_default = $default;
		
		return $this;
		
	}
	
	public function setName($name)
	{
		
		$this->_name = $name;
		
		return $this;
	
	}
	
	public function setVisibility($visibility)
	{
		
		$this->_visibility = $visibility;
		
		return $this;
	
	}
	
}