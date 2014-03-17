<?php

class Inclusive_CodeGenerator_Element
{
	
	protected $_filters = array();
	
	protected $_model = null;
	
	protected $_module = null;
	
	protected $_multiOptions = array();
	
	protected $_name = null;
	
	protected $_required = false;
	
	protected $_spec = null;
	
	protected $_type = 'Text';
	
	protected $_validators = array();
	
	public function __construct($module,$model,$name,$config=null)
	{
	
		$this
			->setModule($module)
			->setModel($model)
			->setName($name);
			
		if (is_array($config))
		{
		
			if (isset($config['required']))
			{
			
				$this->setRequired($config['required']);
			
			}
			
			if (isset($config['spec']))
			{
			
				$this->setSpec($config['spec']);
			
			}
			
			if (isset($config['type']))
			{
			
				$this->setType($config['type']);
			
			}
		
		}
	
	}
	
	public function addFilter(Inclusive_CodeGenerator_Filter $filter)
	{
	
		$this->_filters[$filter->getName()] = $filter;
		
		return $this;
	
	}
	
	public function addMultiOption(Inclusive_CodeGenerator_Element_MultiOption $option)
	{
	
		$this->_multiOptions[$option->getKey()] = $option;
		
		return $this;
	
	}
	
	public function addValidator(Inclusive_CodeGenerator_Validator $validator)
	{
	
		$this->_validators[$validator->getName()] = $validator;
		
		return $this;
	
	}
	
	public function generate()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setName($this->getClassName())
			->setExtends($this->getTypeClass());
		
		$construct = new Inclusive_CodeGenerator_Class_Function();
		
		$string = "";
		
		if ($this->getRequired())
		{
		
			$string .= "\t\tif (!isset(\$options['required']))"
					."\n\t\t{\n\n\t\t\t\$options['required'] = true;\n\n\t\t}";
		
		}
		
		if ($this->getType() == 'Multi' || $this->getType() == 'Select')
		{
		
			if (count($this->getMultiOptions()))
			{
				
				$optionsString = "";
				
				foreach ($this->getMultiOptions() as $option)
				{
				
					$optionsString .= "\t'{$option->getKey()}'=>'{$option->getLabel()}',\n";
				
				}
				
				$optionsString = rtrim(rtrim($optionsString,"\n"),',');
				
				$string .= "\n\tif (!isset(\$options['multiOptions']))"
					."\n{\n\n\t\t\$options['multiOptions'] = array(\n\t{$optionsString}\n\t);\n\n}";
					
			}
		
		}
		
		$string .= "\n\n\t\tparent::__construct(\$spec,\$options);\n";
		
		$construct
			->setName('__construct')
			->setParameterString("\$spec='{$this->getSpec()}',\$options=null")
			->setVisibility('public')
			->setContent($string);
			
		$class->addFunction($construct);
		
		return $class->generate();
	
	}
	
	public function generateTest()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setName($this->getClassName().'Test')
			->setExtends('TestCase');
		
		$string = "\t\t\$element = new {$this->getClassName()}();";
		$string .= "\n\n\t\t\$this->assertInstanceOf('{$this->getTypeClass()}',\$element);\n";
		
		$testInstanceOf = new Inclusive_CodeGenerator_Class_Function();
		$testInstanceOf
			->setName('testInstanceOf')
			->setVisibility('public')
			->setContent($string);
			
		$class->addFunction($testInstanceOf);
		
		if ($this->getRequired())
		{
			
			$string = "\t\t\$element = new {$this->getClassName()}();";
			$string .= "\n\n\t\t\$this->assertTrue(\$element->isRequired());\n";
			
			$testIsRequired = new Inclusive_CodeGenerator_Class_Function();
			$testIsRequired
				->setName('testIsRequired')
				->setVisibility('public')
				->setContent($string);
				
			$class->addFunction($testIsRequired);
			
		}
		
		if ($this->getType() == 'Multi' || $this->getType() == 'Select')
		{
		
			if (count($this->getMultiOptions()))
			{
				
				$optionsString = "";
				
				foreach ($this->getMultiOptions() as $option)
				{
				
					$optionsString .= "\n\t'{$option->getKey()}'=>'{$option->getLabel()}',";
				
				}
				
				$optionsString = rtrim($optionsString,',');
				
				$string = "\t\$element = new {$this->getClassName()}();";
				$string .= "\n\n\t\$this->assertEquals(array({$optionsString}\n\t),\$element->getMultiOptions());";
				
				$testCorrectMultiOptions = new Inclusive_CodeGenerator_Class_Function();
				$testCorrectMultiOptions
					->setName('testCorrectMultiOptions')
					->setContent($string);
					
				$class->addFunction($testCorrectMultiOptions);
				
			}
			
		}
		
		return $class->generate();
	
	}
	
	public function getClassName()
	{
	
		$name = $this->getModule()->getName();
		
		$name .= '_Element_'.$this->getModel();
		
		$name .= '_'.$this->getName();
		
		return $name;
	
	}
	
	public function getFilters()
	{
	
		return $this->_filters;
	
	}
	
	public function getModel()
	{
	
		return $this->_model;
	
	}
	
	public function getModule()
	{
	
		return $this->_module;
	
	}
	
	public function getMultiOptions()
	{
	
		return $this->_multiOptions;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
		
	}
	
	public function getRequired()
	{
	
		return $this->_required;
		
	}
	
	public function getSpec()
	{
	
		return $this->_spec;
	
	}
	
	public function getType()
	{
	
		return $this->_type;
		
	}
	
	public function getTypeClass()
	{
	
		return 'Inclusive_Form_Element_'.ucfirst($this->_type);
		
	}
	
	public function getValidators()
	{
	
		return $this->_validators;
	
	}
	
	public function setFilters(array $filters)
	{
	
		$this->_filters = array();
		
		foreach ($filters as $filter)
		{
		
			$this->addFilter($filter);
		
		}
		
		return $this;
		
	}
	
	public function setModel($model)
	{
	
		$this->_model = $model;
		
		return $this;
		
	}
	
	public function setModule(Inclusive_CodeGenerator_Module $module)
	{
	
		$this->_module = $module;
		
		return $this;
		
	}
	
	public function setMultiOptions(array $options)
	{
	
		$this->_multiOptions = array();
		
		foreach ($options as $option)
		{
		
			$this->addMultiOption($option);
		
		}
		
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
	
	public function setSpec($spec)
	{
	
		$this->_spec = $spec;
		
		return $this;
		
	}
	
	public function setType($type)
	{
	
		$this->_type = ucfirst($type);
		
		return $this;
		
	}
	
	public function setValidators(array $validators)
	{
	
		$this->_validators = array();
		
		foreach ($validators as $validator)
		{
		
			$this->addValidator($validator);
		
		}
		
		return $this;
		
	}
	
}