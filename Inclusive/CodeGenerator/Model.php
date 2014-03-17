<?php

class Inclusive_CodeGenerator_Model
{
	
	protected $_functions = array();
	
	protected $_module = null;
	
	protected $_name = null;
	
	protected $_services = array();
	
	public function __construct($module,$name,$config=null)
	{
	
		$this
			->setModule($module)
			->setName($name);
			
		if (is_array($config))
		{
			
			if (isset($config['functions']))
			{

				$this->setFunctions($config['functions']);
			
			}
			
			if (isset($config['services']))
			{
			
				$this->setServices($config['services']);
			
			}
			
		}
		
	}
	
	public function addFunction($name,$config=null)
	{
	
		$this->_functions[$name] = $config;
		
		return $this;
	
	}
	
	public function addService($key,$class)
	{
	
		$this->_services[$key] = $class;
		
		return $this;
	
	}
	
	public function generate()
	{
		
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setName($this->getClassName())
			->setExtends('Inclusive_Model_Abstract');
		
		if (count($this->getServices()))
		{
			
			$services = new Inclusive_CodeGenerator_Class_Variable_Services();
			$services->setServices($this->getServices());
			
			$class->addVariable($services->toVariable());
			
		}
		
		if (count($this->getFunctions()))
		{
		
			foreach ($this->getFunctions() as $name => $config)
			{
				
				$variable = new Inclusive_CodeGenerator_Class_Variable();
				$variable
					->setName($config['variable'])
					->setVisibility('protected')
					->setDefault('null');
				
				$string = "";
				
				if (isset($config['canBeNull']) && $config['canBeNull'])
				{
					
					foreach ($config['map'] as $key => $value)
					{

						$string .= "\t\tif (null === \$this->{$value})";

					}

					$string .= "\n\t\t{";
					$string .= "\n\n\t\t\treturn null;";
					$string .= "\n\n\t\t}\n\n";
				
				}
				
				$string .= "\t\tif (null === \$this->{$config['variable']})";
				$string .= "\n\t\t{";
				$string .= "\n\n\t\t\t\$this->{$config['variable']} = \$this->getService('{$config['service']}')";
				$string .= "\n\t\t\t\t->fetchOne(array(";
				
				foreach ($config['map'] as $key => $value)
				{
				
					$string .= "\n\t\t\t\t\t'{$key}'=>\$this->{$value}";
				
				}
				
				$string .= "\n\t\t\t\t\t));";
				$string .= "\n\t\t}";
				$string .= "\n\n\t\treturn \$this->{$config['variable']};\n";
				
				$function = new Inclusive_CodeGenerator_Class_Function();
				$function
					->setName($name)
					->setVisibility('public')
					->setContent($string);
					
				$class
					->addVariable($variable)
					->addFunction($function);
			
			}
		
		}
		
		return $class->generate();
		
	}
	
	public function generateTest()
	{
		
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setName($this->getClassName().'Test')
			->setExtends('TestCase');
		
		$string = "\t\t\$model = new {$this->getClassName()}();";
		$string .= "\n\n\t\t\$this->assertInstanceOf('Inclusive_Model_Abstract',\$model);\n";
		
		$function = new Inclusive_CodeGenerator_Class_Function();
		$function
			->setName('testInstanceOfModelAbstract')
			->setVisibility('public')
			->setContent($string);
			
		$class->addFunction($function);
		
		if (count($this->getFunctions()))
		{
		
			foreach ($this->getFunctions() as $name => $config)
			{

				$testName = 'test'.ucfirst($name);
				
				$string = "\t\t\$model = new {$this->getClassName()}();";
				
				$mapString = "";

				$result = 'null';

				if (isset($config['canBeNull']) && $config['canBeNull'])
				{
				
					$result = '1';
					
					$string .= "\n\n\t\t\$actual = \$model->{$name}();";
					$string .= "\n\n\t\t\$this->assertEquals(null,\$actual);";
					
					foreach ($config['map'] as $key => $value)
					{					

						$string .= "\n\n\t\t\$model->{$value} = '1';";

					}
				
				}				
				
				foreach ($config['map'] as $key => $value)
				{
					
					$mapString .= "'{$key}'=>{$result},";
				
				}
				
				$mapString = rtrim($mapString,',');

				$string .= "\n\n\t\t\$expected = '1';";
				$string .= "\n\n\t\t\$service = \$this->getMock('{$this->getService($config['service'])}',array('fetchOne'));";
				$string .= "\n\t\t\$service";
				$string .= "\n\t\t\t->expects(\$this->once())";
				$string .= "\n\t\t\t->method('fetchOne')";
				$string .= "\n\t\t\t->with(array({$mapString}))";
				$string .= "\n\t\t\t->will(\$this->returnValue(\$expected));";
				$string .= "\n\n\t\t\$model->setService(\$service,'{$config['service']}');";
				$string .= "\n\n\t\t\$actual = \$model->{$name}();";
				$string .= "\n\n\t\t\$this->assertEquals(\$expected,\$actual);";
				
				$function = new Inclusive_CodeGenerator_Class_Function();
				$function
					->setName($testName)
					->setVisibility('public')
					->setContent($string);
					
				$class->addFunction($function);
			
			}
		
		}
		
		return $class->generate();
		
	}
	
	public function getClassName()
	{
	
		return $this->getModule()->getName()
			.'_Model_'.$this->getName();
	
	}
	
	public function getModule()
	{
	
		return $this->_module;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function getFunctions()
	{
	
		return $this->_functions;
	
	}
	
	public function getService($key)
	{
	
		return $this->_services[$key];
	
	}
	
	public function getServices()
	{
	
		return $this->_services;
	
	}
	
	public function getSetClassName()
	{
	
		return $this->getModule()->getName()
			.'_Set_'.$this->getName();
	
	}
	
	public function setFunctions(array $functions)
	{
	
		$this->_functions = array();
		
		foreach ($functions as $name => $config)
		{
		
			$this->addFunction($name,$config);
		
		}
		
		return $this;
	
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
	
	public function setServices(array $services)
	{
	
		$this->_services = array();
		
		foreach ($services as $key => $class)
		{
		
			$this->addService($key,$class);
		
		}
		
		return $this;
	
	}
	
}
