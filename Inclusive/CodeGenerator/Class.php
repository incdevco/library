<?php

class Inclusive_CodeGenerator_Class
{
	
	protected $_abstract = false;
	
	protected $_extends = null;
	
	protected $_interface = false;
	
	protected $_interfaces = array();
	
	protected $_name = null;
	
	protected $_functions = array();
	
	protected $_prepend = null;
	
	protected $_variables = array();
	
	public function generate()
	{
		
		$string = "<?php\n\n";
		
		if ($this->getPrepend())
		{
		
			$string .= $this->getPrepend();
		
		}
		
		if ($this->getAbstract())
		{
		
			$string .= 'abstract ';
		
		}
		
		$string .= 'class '.$this->getName();
		
		if ($this->getExtends())
		{
		
			$string .= ' extends '.$this->getExtends();
		
		}
		
		if ($this->hasInterfaces())
		{
			
			$string .= ' implements ';
			
			foreach ($this->getInterfaces() as $interface)
			{
			
				$string .= $interface.',';
			
			}
			
			$string = rtrim($string,',');
		
		}
		
		$string .= "\n{\n\n";
		
		foreach ($this->getVariables() as $variable) 
		{
		
			$string .= $variable->generate()."\n\n";
		
		}
		
		foreach ($this->getFunctions() as $function) 
		{
		
			$string .= $function->generate();
		
		}
		
		$string .= "}\n";
		
		return $string;
		
	}
	
	public function addFunction(Inclusive_CodeGenerator_Class_Function $function)
	{
		
		$this->_functions[$function->getName()] = $function;
		
		return $this;
	
	}
	
	public function addInterface($interface)
	{
			
		if (!in_array($interface,$this->_interfaces))
		{
				
			$this->_interface[] = $interface;
			
		}
		
		return $this;
	
	}
	
	public function addVariable(Inclusive_CodeGenerator_Class_Variable $variable)
	{
		
		$this->_variables[$variable->getName()] = $variable;
		
		return $this;
	
	}
	
	public function getAbstract()
	{
	
		return $this->_abstract;
	
	}
	
	public function getExtends()
	{
	
		return $this->_extends;
	
	}
	
	public function getFunctions()
	{
	
		return $this->_functions;
		
	}
	
	public function getInterfaces()
	{
	
		return $this->_interfaces;
		
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function getPrepend()
	{
	
		return $this->_prepend;
		
	}
	
	public function getVariables()
	{
	
		return $this->_variables;
		
	}
	
	public function hasInterfaces()
	{
	
		return (count($this->getInterfaces())) ? true : false;
	
	}
	
	public function removeFunction($name)
	{
	
		if (isset($this->_functions[$name]))
		{
		
			unset($this->_functions[$name]);
		
		}
		
		return $this;
	
	}
	
	public function removeInterface($interface)
	{
	
		if (isset($this->_interfaces[$interface]))
		{
		
			unset($this->_interfaces[$interface]);
		
		}
		
		return $this;
	
	}
	
	public function removeVariable($name)
	{
	
		if (isset($this->_variables[$name]))
		{
		
			unset($this->_variables[$name]);
		
		}
		
		return $this;
	
	}
	
	public function setAbstract($abstract)
	{
	
		$this->_abstract = ($abstract) ? true : false;
		
		return $this;
	
	}
	
	public function setExtends($extends)
	{
	
		$this->_extends = $extends;
		
		return $this;
	
	}
	
	public function setFunctions(array $functions)
	{
	
		$this->_functions = array();
		
		foreach ($functions as $function)
		{
		
			$this->addFunction($function);
		
		}
		
		return $this;
	
	}
	
	public function setInterfaces(array $interfaces)
	{
	
		$this->_interfaces = array();
		
		foreach ($interfaces as $interface)
		{
		
			$this->addInterface($interface);
		
		}
		
		return $this;
	
	}
	
	public function setName($name)
	{
	
		$this->_name = $name;
		
		return $this;
	
	}
	
	public function setPrepend($prepend)
	{
	
		$this->_prepend = $prepend;
		
		return $this;
	
	}
	
	public function setVariables(array $variables)
	{
	
		$this->_variables = array();
		
		foreach ($variables as $variable)
		{
		
			$this->addVariable($variable);
		
		}
		
		return $this;
	
	}
	
}