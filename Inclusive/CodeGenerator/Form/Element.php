<?php

class Inclusive_CodeGenerator_Form_Element
{

	protected $_class = null;
	
	protected $_ifEmpty = null;
	
	protected $_options = null;
	
	protected $_spec = null;
	
	public function getClass()
	{
	
		return $this->_class;
	
	}
	
	public function getIfEmpty()
	{
	
		return $this->_ifEmpty;
	
	}
	
	public function getOptions()
	{
	
		return $this->_options;
	
	}
	
	public function getSpec()
	{
	
		return $this->_spec;
	
	}
	
	public function setClass($class)
	{
		
		$this->_class = $class;
		
		return $this;
	
	}
	
	public function setIfEmpty($ifEmpty)
	{
		
		$this->_ifEmpty = $ifEmpty;
		
		return $this;
	
	}
	
	public function setOptions($options)
	{
		
		$this->_options = $options;
		
		return $this;
	
	}
	
	public function setSpec($spec)
	{
		
		$this->_spec = $spec;
		
		return $this;
	
	}
	
}