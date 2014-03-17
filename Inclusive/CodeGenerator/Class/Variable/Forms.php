<?php

class Inclusive_CodeGenerator_Class_Variable_Forms
{
	
	protected $_forms = array();
	
	public function addForm($key,$class)
	{
	
		$this->_forms[$key] = $class;
		
		return $this;
	
	}
	
	public function getForms()
	{
	
		return $this->_forms;
	
	}
	
	public function setForms(array $forms)
	{
	
		$this->_forms = array();
		
		foreach ($forms as $key => $class)
		{
		
			$this->addForm($key,$class);
		
		}
		
		return $this;
	
	}
	
	public function toVariable()
	{
	
		$variable = new Inclusive_CodeGenerator_Class_Variable();
		$variable
			->setVisibility('protected')
			->setName('_formClasses');
		
		$string = "array(";
		
		foreach ($this->getForms() as $key => $class)
		{
		
			$string .= "\n\t\t'{$key}'=>'{$class}',";
		
		}
		
		$string = rtrim($string,',');
		
		$string .= "\n\t\t)";
		
		$variable->setDefault($string);
		
		return $variable;
	
	}

}