<?php

class Inclusive_CodeGenerator_Set
{

	protected $_module = null;
	
	protected $_name = null;
	
	public function __construct($module,$name,$config=null)
	{
	
		$this
			->setModule($module)
			->setName($name);
	
	}
	
	public function generate()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setName($this->getClassName())
			->setExtends('Inclusive_Set_Abstract');
			
		return $class->generate();
	
	}
	
	public function generateTest()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setName($this->getClassName().'Test')
			->setExtends('TestCase');
		
		$string = "\t\t\$set = new {$this->getClassName()}();";
		$string .= "\n\n\t\t\$this->assertInstanceOf('Inclusive_Set_Abstract',\$set);\n";
		
		$function = new Inclusive_CodeGenerator_Class_Function();
		$function
			->setName('testInstanceOfSetAbstract')
			->setVisibility('public')
			->setContent($string);
			
		$class->addFunction($function);
		
		return $class->generate();
	
	}
	
	public function getClassName()
	{
	
		return $this->getModule()->getName().'_Set_'.$this->getName();
	
	}
	
	public function getModule()
	{
	
		return $this->_module;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function setModule(Inclusive_CodeGenerator_Module $module)
	{
	
		$this->_module = $module;
		
		return $this;
	
	}
	
	public function setName($name)
	{
	
		$this->_name = $name;
		
		return $this;
	
	}
	
}