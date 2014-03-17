<?php

class Inclusive_CodeGenerator_Class_Variable_Services
{
	
	protected $_services = array();
	
	public function addService($key,$class)
	{
	
		$this->_services[$key] = $class;
		
		return $this;
	
	}
	
	public function getServices()
	{
	
		return $this->_services;
	
	}
	
	public function setServices(array $services)
	{
	
		$this->_services = array();
		
		foreach ($services as $key => $class)
		{
		
			$this->addService($key,$class);
		
		}
		
		return $this;
	
	}
	
	public function toVariable()
	{
	
		$variable = new Inclusive_CodeGenerator_Class_Variable();
		$variable
			->setName('_serviceClasses')
			->setVisibility('protected');
		
		$string = "array(";
		
		foreach ($this->getServices() as $key => $class)
		{
		
			$string .= "\n\t\t'{$key}'=>'{$class}',";
		
		}
		
		$string = rtrim($string,',');
		
		$string .= "\n\t\t)";
		
		$variable->setDefault($string);
		
		return $variable;
	
	}

}