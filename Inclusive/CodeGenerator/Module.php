<?php

class Inclusive_CodeGenerator_Module
{
	
	protected $_assertions = array();
	
	protected $_bootstrap = null;
	
	protected $_controllers = array();
	
	protected $_elements = array();
	
	protected $_filters = array();
	
	protected $_forms = array();
	
	protected $_models = array();
	
	protected $_name = null;
	
	protected $_scriptPath = null;
	
	protected $_testPath = null;
	
	protected $_services = array();
	
	protected $_sets = array();
	
	protected $_writer = null;
	
	public function __construct($config)
	{
	
		if (is_string($config))
		{
			
			$path = $config;
			
			$config = include $config;
			
		}
		
		$this
			->setName($config['name'])
			->setScriptPath($config['scriptPath'])
			->setTestPath($config['testPath']);
		
		if (isset($config['controllers']))
		{
		
			$this->setControllers($config['controllers']);
		
		}
		
		if (isset($config['elements']))
		{
			
			$this->setElements($config['elements']);
		
		}
		
		if (isset($config['forms']))
		{
		
			$this->setForms($config['forms']);
		
		}
		
		if (isset($config['models']))
		{
			
			$this->setModels($config['models']);
		
		}
		
		if (isset($config['services']))
		{
		
			$this->setServices($config['services']);
		
		}
		
		if (isset($config['sets']))
		{
		
			$this->setSets($config['sets']);
		
		}
				
	}
	
	public function addAssertion($assertion)
	{
	
		$this->_assertions[] = $assertion;
		
		return $this;
	
	}
	
	public function addController($name,$config=null)
	{
		
		$this->_controllers[$name] = $config;
		
		return $this;
	
	}
	
	public function addElement($model,$name,$config=null)
	{
		
		if (!isset($this->_elements[$model]))
		{
		
			$this->_elements[$model] = array();
		
		}
		
		$this->_elements[$model][$name] = $config;
		
		return $this;
	
	}
	
	public function addFilter($filter)
	{
	
		$this->_filters[] = $filter;
		
		return $this;
	
	}
	
	public function addForm($model,$name,$config=null)
	{
		
		if (!isset($this->_forms[$model]))
		{
		
			$this->_forms[$model] = array();
		
		}
		
		$this->_forms[$model][$name] = $config;
		
		return $this;
	
	}
	
	public function addModel($name,$config=null)
	{
		
		$this->_models[$name] = $config;
		
		return $this;
	
	}
	
	public function addService($name,$config=null)
	{
	
		$this->_services[$name] = $config;
		
		return $this;
	
	}
	
	public function addSet($name,$config=null)
	{
		
		$this->_sets[$name] = $config;
		
		return $this;
	
	}
	
	public function convertActionToScript($action)
	{
	
		return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $action));
		
	}
	
	public function generate()
	{
		
		$scriptBase = $this->getScriptPath().'/'.strtolower($this->getName());
		$testBase = $this->getTestPath().'/'.strtolower($this->getName());
		
		$this->getWriter()->makeDirectory($scriptBase,true);
		
		$this->getWriter()->makeDirectory($testBase,true);
		
		// Assertions
		
		if (count($this->getAssertions()))
		{
			
			$this->getWriter()->makeDirectory($scriptBase.'/assertions');
			
			$this->getWriter()->makeDirectory($testBase.'/assertions');
			
			foreach ($this->getAssertions() as $assertion)
			{
				
				$path = $scriptBase.'/assertions/'.$assertion->getModel()->getName().'/'.$assertion->getName().'.php';
				
				$this->getWriter()->writeFile($path,$assertion->generate());
				
				$path = $testBase.'/assertions/'.$assertion->getModel()->getName().'/'.$assertion->getName().'Test.php';
				
				$this->getWriter()->writeFile($path,$assertion->generateTest());
				
			}
			
		}
		
		// Bootstrap
		
		$path = $scriptBase.'/Bootstrap.php';
		
		$this->getWriter()->writeFile($path,$this->getBootstrap()->generate());
		
		$path = $testBase.'/BootstrapTest.php';
		
		$this->getWriter()->writeFile($path,$this->getBootstrap()->generateTest());
		
		// Controllers
		
		if (count($this->getControllers()))
		{
			
			$this->getWriter()->makeDirectory($scriptBase.'/controllers');
			
			$this->getWriter()->makeDirectory($testBase.'/controllers');
			
			foreach ($this->getControllers() as $name => $config)
			{
				
				$controller = new Inclusive_CodeGenerator_Controller($this,$name,$config);
				
				$path = $scriptBase.'/controllers/'.$name.'Controller.php';
				
				$this->getWriter()->writeFile($path,$controller->generate());
				
				$path = $testBase.'/controllers/'.$name.'ControllerTest.php';
				
				$this->getWriter()->writeFile($path,$controller->generateTest());
				
				foreach ($controller->getActionObjects() as $action)
				{
					
					$script = $this->convertActionToScript($action->getName());
					
					$path = $scriptBase.'/views/scripts/'
						.strtolower($controller->getName()).'/'.$script.'.phtml';
					
					$this->getWriter()->writeFile($path,$action->generate());
				
				}
				
			}
			
		}
		
		// Elements
		
		if (count($this->getElements()))
		{
			
			$this->getWriter()->makeDirectory($scriptBase.'/elements');
			
			$this->getWriter()->makeDirectory($testBase.'/elements');
			
			foreach ($this->getElements() as $model => $elements)
			{
				
				foreach ($elements as $name => $config)
				{
					
					$scriptPath = $scriptBase.'/elements';
					$testPath = $testBase.'/elements';
					
					if (preg_match('/_/',$model))
					{
					
						$parts = explode('_',$model);
						
						foreach ($parts as $part)
						{
						
							$scriptPath .= '/'.$part;
							$testPath .= '/'.$part;
						
						}
						
						$scriptPath .= '/'.$name.'.php';
						$testPath .= '/'.$name.'Test.php';
						
					}
					else 
					{
					
						$scriptPath .= '/'.$model.'/'.$name.'.php';
						$testPath .= '/'.$model.'/'.$name.'Test.php';
					
					}
					
					$element = new Inclusive_CodeGenerator_Element($this,$model,$name,$config);
					
					$this->getWriter()->writeFile($scriptPath,$element->generate());
					
					$this->getWriter()->writeFile($testPath,$element->generateTest());
					
				}
				
			}
			
		}
		
		// Filters
		
		if (count($this->getFilters()))
		{
			
			$this->getWriter()->makeDirectory($scriptBase.'/filters');
			
			$this->getWriter()->makeDirectory($testBase.'/filters');
			
			foreach ($this->getFilters() as $filter)
			{
				
				$scriptPath = $scriptBase.'/filters';
				$testPath = $testBase.'/filters';
				
				if (preg_match('/_/',$filter->getModel()->getName()))
				{
				
					$parts = explode('_',$filter->getModel()->getName());
					
					foreach ($parts as $part)
					{
					
						$scriptPath .= '/'.$part;
						$testPath .= '/'.$part;
					
					}
					
					$scriptPath .= '/'.$filter->getName().'.php';
					$testPath .= '/'.$filter->getName().'Test.php';
					
				}
				else 
				{
				
					$scriptPath .= '/'.$filter->getModel()->getName().'/'.$filter->getName().'.php';
					$testPath .= '/'.$filter->getModel()->getName().'/'.$filter->getName().'Test.php';
				
				}
				
				$path = $scriptBase.'/filters/'.$filter->getModel()->getName().'/'.$filter->getName().'.php';
				
				$this->getWriter()->writeFile($scriptPath,$filter->generate());
				
				$path = $testBase.'/filters/'.$filter->getModel()->getName().'/'.$filter->getName().'Test.php';
				
				$this->getWriter()->writeFile($testPath,$filter->generateTest());
				
			}
			
		}
		
		// Forms
		
		if (count($this->getForms()))
		{
			
			$this->getWriter()->makeDirectory($scriptBase.'/forms');
			
			$this->getWriter()->makeDirectory($testBase.'/forms');
			
			foreach ($this->getForms() as $model => $forms)
			{
				
				foreach ($forms as $name => $config)
				{
					
					$scriptPath = $scriptBase.'/forms';
					$testPath = $testBase.'/forms';
					
					if (preg_match('/_/',$model))
					{
					
						$parts = explode('_',$model);
						
						foreach ($parts as $part)
						{
						
							$scriptPath .= '/'.$part;
							$testPath .= '/'.$part;
						
						}
						
						$scriptPath .= '/'.$name.'.php';
						$testPath .= '/'.$name.'Test.php';
						
					}
					else 
					{
					
						$scriptPath .= '/'.$model.'/'.$name.'.php';
						$testPath .= '/'.$model.'/'.$name.'Test.php';
					
					}
					
					$form = new Inclusive_CodeGenerator_Form($this,$model,$name,$config);
					
					$this->getWriter()->writeFile($scriptPath,$form->generate());
					
					$this->getWriter()->writeFile($testPath,$form->generateTest());
					
				}
				
			}
			
		}
		
		// Models
		
		if (count($this->getModels()))
		{
			
			$this->getWriter()->makeDirectory($scriptBase.'/models');
			
			$this->getWriter()->makeDirectory($testBase.'/models');
			
			foreach ($this->getModels() as $name => $config)
			{
				
				$scriptPath = $scriptBase.'/models';
				$testPath = $testBase.'/models';
				
				if (preg_match('/_/',$name))
				{
				
					$parts = explode('_',$name);
					
					foreach ($parts as $part)
					{
					
						$scriptPath .= '/'.$part;
						$testPath .= '/'.$part;
					
					}
					
					$scriptPath .= '.php';
					$testPath .= 'Test.php';
					
				}
				else 
				{
				
					$scriptPath .= '/'.$name.'.php';
					$testPath .= '/'.$name.'Test.php';
				
				}
				
				$model = new Inclusive_CodeGenerator_Model($this,$name,$config);
				
				$this->getWriter()->writeFile($scriptPath,$model->generate());
				
				$this->getWriter()->writeFile($testPath,$model->generateTest());
				
			}
			
		}
		
		// Services
		
		if (count($this->getServices()))
		{
			
			$this->getWriter()->makeDirectory($scriptBase.'/services');
			
			$this->getWriter()->makeDirectory($testBase.'/services');
					
			foreach ($this->getServices() as $name => $config)
			{
				
				$scriptPath = $scriptBase.'/services';
				$testPath = $testBase.'/services';
				
				if (preg_match('/_/',$name))
				{
				
					$parts = explode('_',$name);
					
					foreach ($parts as $part)
					{
					
						$scriptPath .= '/'.$part;
						$testPath .= '/'.$part;
					
					}
					
					$servicePath = $scriptPath;
					
					$scriptPath .= '.php';
					$testPath .= 'Test.php';
					
				}
				else 
				{
					
					$servicePath = $scriptPath.'/'.$name;
					$scriptPath .= '/'.$name.'.php';
					$testPath .= '/'.$name.'Test.php';
				
				}
				
				$service = new Inclusive_CodeGenerator_Service($this,$name,$config);
				
				$this->getWriter()->writeFile($scriptPath,$service->generate());
				
				$adapterPath = $servicePath.'/Adapter.php';
				
				$this->getWriter()->writeFile($adapterPath,$service->generateAdapter());
				
				$tablePath = $servicePath.'/Table.php';
				
				$this->getWriter()->writeFile($tablePath,$service->generateTable());
				
				$this->getWriter()->writeFile($testPath,$service->generateTest());
				
			}
			
		}
		
		// Sets
		
		if (count($this->getSets()))
		{
			
			$this->getWriter()->makeDirectory($scriptBase.'/sets');
			
			$this->getWriter()->makeDirectory($testBase.'/sets');
					
			foreach ($this->getSets() as $name => $config)
			{
				
				$scriptPath = $scriptBase.'/sets';
				$testPath = $testBase.'/sets';
				
				if (preg_match('/_/',$name))
				{
				
					$parts = explode('_',$name);
					
					foreach ($parts as $part)
					{
					
						$scriptPath .= '/'.$part;
						$testPath .= '/'.$part;
					
					}
					
					$scriptPath .= '.php';
					$testPath .= 'Test.php';
					
				}
				else 
				{
				
					$scriptPath .= '/'.$name.'.php';
					$testPath .= '/'.$name.'Test.php';
				
				}
				
				$set = new Inclusive_CodeGenerator_Set($this,$name,$config);
				
				$this->getWriter()->writeFile($scriptPath,$set->generate());
				
				$this->getWriter()->writeFile($testPath,$set->generateTest());
				
			}
			
		}
		
		return true;
		
	}
	
	public function getAssertions()
	{
	
		return $this->_assertions;
	
	}
	
	public function getBootstrap()
	{
		
		if (null === $this->_bootstrap)
		{
		
			$this->_bootstrap = new Inclusive_CodeGenerator_Module_Bootstrap();
			
			$this->_bootstrap->setModule($this);
		
		}
		
		return $this->_bootstrap;
	
	}
	
	public function getController($name)
	{
	
		if (!isset($this->_controllers[$name]))
		{
		
			return false;
		
		}
		
		return $this->_controllers[$name];
	
	}
	
	public function getControllers()
	{
	
		return $this->_controllers;
	
	}
	
	public function getElement($model,$name)
	{
	
		if (!isset($this->_elements[$model][$name]))
		{
		
			return false;
		
		}
	
		return $this->_elements[$model][$name];
	
	}
	
	public function getElements()
	{
	
		return $this->_elements;
	
	}
	
	public function getFilters()
	{
	
		return $this->_filters;
	
	}
	
	public function getForm($model,$name)
	{
		
		if (!isset($this->_forms[$model][$name]))
		{
		
			return false;
			
		}
		
		return $this->_forms[$model][$name];
	
	}
	
	public function getForms()
	{
	
		return $this->_forms;
	
	}
	
	public function getModel($name)
	{
	
		return $this->_models[$name];
	
	}
	
	public function getModels()
	{
	
		return $this->_models;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function getScriptPath()
	{
	
		return $this->_scriptPath;
	
	}
	
	public function getTestPath()
	{
	
		return $this->_testPath;
	
	}
	
	public function getService($name)
	{
	
		return $this->_services[$name];
	
	}
	
	public function getServices()
	{
	
		return $this->_services;
	
	}
	
	public function getSet($name)
	{
	
		return $this->_sets[$name];
	
	}
	
	public function getSets()
	{
	
		return $this->_sets;
	
	}
	
	public function getWriter()
	{
	
		if (null === $this->_writer)
		{
		
			$this->_writer = new Inclusive_CodeGenerator_Writer();
		
		}
		
		return $this->_writer;
	
	}
	
	public function setAssertions(array $assertions)
	{
	
		$this->_assertions = array();
		
		foreach ($assertions as $assertion)
		{
		
			$this->addAssertion($assertion);
		
		}
		
		return $this;
	
	}
	
	public function setControllers(array $controllers)
	{
		
		$this->_controllers = array();
		
		foreach ($controllers as $name => $config)
		{
			
			$this->addController($name,$config);
		
		}
		
		return $this;
	
	}
	
	public function setElements(array $elements)
	{
		
		$this->_elements = array();
		
		foreach ($elements as $model => $els)
		{
			
			foreach ($els as $name => $config)
			{
				
				$this->addElement($model,$name,$config);
			
			}
		
		}
		
		return $this;
	
	}
	
	public function setFilters(array $filters)
	{
	
		$this->_filters = array();
		
		foreach ($filters as $name => $config)
		{
		
			$this->addFilter($name,$config);
		
		}
		
		return $this;
	
	}
	
	public function setForms(array $forms)
	{
	
		$this->_forms = array();
		
		foreach ($forms as $model => $frms)
		{
			
			foreach ($frms as $name => $config)
			{
				
				$this->addForm($model,$name,$config);
				
			}
		
		}
		
		return $this;
	
	}
	
	public function setModels(array $models)
	{
	
		$this->_models = array();
		
		foreach ($models as $name => $config)
		{
		
			$this->addModel($name,$config);
		
		}
		
		return $this;
	
	}
	
	public function setName($name)
	{
	
		$this->_name = $name;
		
		return $this;
	
	}
	
	public function setScriptPath($path)
	{
	
		$this->_scriptPath = $path;
		
		return $this;
	
	}
	
	public function setTestPath($path)
	{
	
		$this->_testPath = $path;
		
		return $this;
	
	}
	
	public function setServices(array $services)
	{
	
		$this->_services = array();
		
		foreach ($services as $name => $config)
		{
		
			$this->addService($name,$config);
		
		}
		
		return $this;
	
	}
	
	public function setSets(array $sets)
	{
	
		$this->_sets = array();
		
		foreach ($sets as $name => $config)
		{
		
			$this->addSet($name,$config);
		
		}
		
		return $this;
	
	}
	
	public function setWriter(Inclusive_CodeGenerator_Writer $writer)
	{
	
		$this->_writer = $writer;
		
		return $this;
	
	}
	
}
