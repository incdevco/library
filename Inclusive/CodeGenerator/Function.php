<?php

class Inclusive_CodeGenerator_Function
{
	
	protected $_content = null;
	
	protected $_name = null;
	
	protected $_parameterString = '';
	
	protected $_static = false;
	
	protected $_visibility = 'private';
	
	public function generate()
	{
		
		$string = $this->generateHead();
		
		$string .= $this->generateBody();
		
		return $string;
	
	}
	
	public function generateHead()
	{
		
		$string = $this->getVisibility().' ';
		
		if ($this->getStatic())
		{
		
			$string .= 'static ';
		
		}
		
		$string .= 'function '.$this->getName().'(';
		
		$string .= $this->getParameterString();
		
		$string .= ")\n";
		
		return $string;
	
	}
	
	public function generateBody()
	{
	
		$string = "\t{\n\n";
		
		if ($this->getContent())
		{
		
			$string .= $this->getContent();
		
		}
		
		$string .= "\n\t}\n\n";
		
		return $string;
	
	}
	
	public function getContent()
	{
	
		return $this->_content;
		
	}
	
	public function getName()
	{
	
		return $this->_name;
		
	}
	
	public function getParameterString()
	{
	
		return $this->_parameterString;
		
	}
	
	public function getStatic()
	{
	
		return $this->_static;
		
	}
	
	public function getVisibility()
	{
	
		return $this->_visibility;
		
	}
	
	public function setContent($content)
	{
		
		$this->_content = $content;
		
		return $this;
		
	}
	
	public function setParameterString($string)
	{
	
		$this->_parameterString = $string;
		
		return $this;
	
	}
	
	public function setStatic($static)
	{
		
		$this->_static = ($static) ? true : false;
		
		return $this;
		
	}
	
	public function setVisibility($visibility)
	{
		
		$this->_visibility = $visibility;
		
		return $this;
		
	}
	
	public function setName($name)
	{
		
		$this->_name = $name;
		
		return $this;
		
	}
	
}