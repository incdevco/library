<?php

class Inclusive_CodeGenerator_Function_Parameter
{
	
	protected $_default = null;
	
	protected $_name = null;
	
	protected $_required = false;
	
	protected $_type = null;
	
	public function generate()
	{
	
		$string = '';
		
		if (null != $this->getType())
		{
		
			$string .= $this->getType().' ';
		
		}
		
		$string .= '$'.$this->getName();
		
		if ($this->getRequired())
		{
		
			
		
		}
		else 
		{
		
			$string .= '='.$this->getDefault();
		
		}
		
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
	
	public function getRequired()
	{
	
		return $this->_required;
	
	}
	
	public function getType()
	{
	
		return $this->_type;
	
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
	
	public function setRequired($required)
	{
		
		$this->_required = ($required) ? true : false;
		
		return $this;
	
	}
	
	public function setType($type)
	{
		
		$this->_type = $type;
		
		return $this;
	
	}
	
}