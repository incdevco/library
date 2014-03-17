<?php

class Inclusive_CodeGenerator_Form
{
	
	protected $_elements = array();
	
	protected $_ifEmptySetNull = null;
	
	protected $_ifEmptyUnset = null;

	protected $_isValid = null;

	protected $_isValidTest = null;
	
	protected $_model = null;
	
	protected $_module = null;
	
	protected $_name = null;

	protected $_subForms = array();
	
	public function __construct($module,$model,$name,$config=null)
	{
	
		$this
			->setModule($module)
			->setModel($model)
			->setName($name);
			
		if (is_array($config))
		{
			
			if (isset($config['elements']))
			{
			
				$this->setElements($config['elements']);
			
			}
			
			if (isset($config['ifEmptySetNull']))
			{
			
				$this->setIfEmptySetNull($config['ifEmptySetNull']);
			
			}
			
			if (isset($config['ifEmptyUnset']))
			{
			
				$this->setIfEmptyUnset($config['ifEmptyUnset']);
			
			}

			if (isset($config['isValid']))
			{

				$this->setIsValid($config['isValid']);

			}

			if (isset($config['isValidTest']))
                        {

                                $this->setIsValidTest($config['isValidTest']);

                        }

			if (isset($config['subForms']))
			{

				$this->setSubForms($config['subForms']);

			}
			
		}
	
	}
	
	public function addElement($spec,$config=null)
	{
	
		$this->_elements[$spec] = $config;
		
		return $this;
	
	}

	public function addSubForm($spec,$config)
	{

		$this->_subForms[$spec] = $config;

		return $this;

	}
	
	public function generate()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		
		$class
			->setName($this->getClassName())
			->setExtends('Inclusive_Form');
		
		if (count($this->getElements()))
		{
			
			$string = "\t\t\$this";
			
			foreach ($this->getElements() as $spec => $config)
			{
				
				if (!isset($config['class']))
				{
					echo $spec;
					print_r($config);
				
				}
				
				$string .= "\n\t\t\t->addElement(new {$config['class']}('{$spec}'";
				
				if (isset($config['options']))
				{
				
					$string .= ",array(";

					foreach ($config['options'] as $key => $value)
					{
						
						if (true === $value)
						{

							$value = 'true';

						}
						elseif (false === $value)
						{

							$value = 'false';

						}
						
						$string .= "'{$key}'=>{$value},";

					}
					
					$string = rtrim($string,',');

					$string .= ")";
					
				}
					
				$string .="))";
			
			}
			
			$string .= ";\n";
			
			$init = new Inclusive_CodeGenerator_Class_Function();
			$init
				->setName('init')
				->setContent($string)
				->setVisibility('public');
				
			$class->addFunction($init);
			
			if ($this->getIfEmptySetNull())
			{
				
				$setNull = "array(";
				
				foreach ($this->getIfEmptySetNull() as $key)
				{
				
					$setNull .= "'{$key}',";
					
				}
				
				$setNull = rtrim($setNull,',');
				
				$setNull .= ")";
				
				$ifEmptySetNull = new Inclusive_CodeGenerator_Class_Variable();
				$ifEmptySetNull
					->setName('_ifEmptySetNull')
					->setVisibility('protected')
					->setDefault($setNull);
					
				$class->addVariable($ifEmptySetNull);
			
			}
			
			if ($this->getIfEmptyUnset())
			{
				
				$unset = "array(";
				
				foreach ($this->getIfEmptyUnset() as $key)
				{
				
					$unset .= "'{$key}',";
					
				}
				
				$unset = rtrim($unset,',');
				
				$unset .= ")";
				
				$ifEmptyUnset = new Inclusive_CodeGenerator_Class_Variable();
				$ifEmptyUnset
					->setName('_ifEmptyUnset')
					->setVisibility('protected')
					->setDefault($unset);
			
				$class->addVariable($ifEmptyUnset);
			
			}
				
		}

		if ($this->getIsValid())
		{

			$function = new Inclusive_CodeGenerator_Class_Function();
			$function
				->setName('isValid')
				->setVisibility('public')
				->setParameterString('$data')
				->setContent($this->getIsValid());

			$class->addFunction($function);

		}
		
		return $class->generate();
	
	}
	
	public function generateTest()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		
		$name = $this->getModule()->getName()
				.'_Form_'.$this->getModel()
				.'_'.$this->getName().'Test';
		
		$class->setName($name);
		
		$class->setExtends('TestCase');
		
		if (count($this->getElements()))
		{
			
			$string = "\t\t\$form = new {$this->getClassName()}();\n";
			
			foreach ($this->getElements() as $spec => $config)
			{
			
				$string .= "\n\t\t\$this->assertInstanceOf('{$config['class']}',\$form->getElement('{$spec}'));";
			
			}
			
			$string .= "\n";
			
			$testCorrectElements = new Inclusive_CodeGenerator_Class_Function();
			$testCorrectElements
				->setName('testCorrectElements')
				->setVisibility('public')
				->setContent($string);
				
			$class->addFunction($testCorrectElements);
				
		}
		
		$string = "\t\t\$form = new {$this->getClassName()}();";
		
		$string .= "\n\n\t\t\$this->assertInstanceOf('Inclusive_Form',\$form);\n";
		
		$testExtendsInclusiveForm = new Inclusive_CodeGenerator_Class_Function();
		$testExtendsInclusiveForm
			->setName('testExtendsInclusiveForm')
			->setVisibility('public')
			->setContent($string);
			
		$class->addFunction($testExtendsInclusiveForm);

		if ($this->getIsValidTest())
		{

			$function = new Inclusive_CodeGenerator_Class_Function();
			$function
				->setName('testIsValid')
				->setVisibility('public')
				->setContent($this->getIsValidTest());

			$class->addFunction($function);

		}		

		return $class->generate();
	
	}
	
	public function getClassName()
	{
	
		$name = $this->getModule()->getName();
		
		$name .= '_Form_'.$this->getModel();
		
		$name .= '_'.$this->getName();
		
		return $name;
	
	}
	
	public function getElements()
	{
	
		return $this->_elements;
	
	}
	
	public function getIfEmptySetNull()
	{
	
		return $this->_ifEmptySetNull;
	
	}
	
	public function getIfEmptyUnset()
	{
	
		return $this->_ifEmptyUnset;
	
	}

	public function getIsValid()
	{

		return $this->_isValid;

	}

	public function getIsValidTest()
	{

		return $this->_isValidTest;

	}
	
	public function getModel()
	{
	
		return $this->_model;
	
	}
	
	public function getModule()
	{
	
		return $this->_module;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}

	public function getSubForms()
	{

		return $this->_subForms;

	}
	
	public function setElements(array $elements)
	{
	
		$this->_elements = array();
		
		foreach ($elements as $spec => $config)
		{
		
			$this->addElement($spec,$config);
		
		}
		
		return $this;
	
	}
	
	public function setIfEmptySetNull($setNull)
	{
	
		$this->_ifEmptySetNull = $setNull;
		
		return $this;
	
	}
	
	public function setIfEmptyUnset($unset)
	{
	
		$this->_ifEmptyUnset = $unset;
		
		return $this;
	
	}

	public function setIsValid($isValid)
	{

		$this->_isValid = $isValid;

		return $this;

	}

	public function setIsValidTest($isValid)
	{

		$this->_isValidTest = $isValid;

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
	
	public function setName($name)
	{
	
		$this->_name = $name;
		
		return $this;
	
	}

	public function setSubForms(array $forms)
	{

		$this->_subForms = array();

		foreach ($forms as $spec => $config)
		{

			$this->addSubForm($spec,$config);

		}

		return $this;

	}
	
}
