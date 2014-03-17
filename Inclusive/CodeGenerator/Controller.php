<?php

require_once 'Controller/Action.php';

class Inclusive_CodeGenerator_Controller
{
	
	protected $_actions = array();
	
	protected $_name = null;
	
	protected $_module = null;
	
	protected $_services = array();
	
	public function __construct($module,$name,$config=null)
	{
		
		$this->setModule($module);
		
		$this->setName($name);
		
		if (is_array($config))
		{
			
			if (isset($config['actions']))
			{
				
				foreach ($config['actions'] as $name => $aconfig)
				{
				
					$this->addAction($name,$aconfig);
				
				}
				
			}
			
			if (isset($config['services']))
			{
				
				foreach ($config['services'] as $key => $class)
				{
				
					$this->addService($key,$class);
				
				}
				
			}
		
		}
	
	}
	
	public function addAction($name,$config=null)
	{
		
		$this->_actions[$name] = $config;
		
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
		
		$class->setName($this->getClassName());
		
		$class->setExtends('Inclusive_Controller_Action');
		
		$services = new Inclusive_CodeGenerator_Class_Variable_Services();
		$services->setServices($this->getServices());
		
		$class->addVariable($services->toVariable());
		
		foreach ($this->getActions() as $name => $config)
		{
			
			$action = new Inclusive_CodeGenerator_Controller_Action($this,$name,$config);
			
			$class->addFunction($action->toFunction());
		
		}
		
		return $class->generate();
		
	}
	
	public function generateTest()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		
		$moduleName = strtolower($this->getModule()->getName());
		
		$prepend = "require_once APPLICATION_PATH.'/modules/";
		$prepend .= strtolower($this->getModule()->getName());
		$prepend .= "/controllers/";
		$prepend .= $this->getName();
		$prepend .= "Controller.php';\n\n";
		
		$class
			->setName($this->getClassName().'Test')
			->setExtends('ControllerTestCase')
			->setPrepend($prepend);
		
		foreach ($this->getActions() as $name => $config)
		{
			
			$action = new Inclusive_CodeGenerator_Controller_Action($this,$name,$config);
			
			$class->addFunction($action->toTestFunction());
		
		}
		
		return $class->generate();
	
	}
	
	public function getAction($name)
	{
	
		if (!isset($this->_actions[$name]))
		{
		
			return false;
			
		}
		
		return $this->_actions[$name];
	
	}
	
	public function getActions()
	{
	
		return $this->_actions;
		
	}
	
	public function getActionObjects()
	{
	
		$objects = array();
		
		foreach ($this->getActions() as $name => $config)
		{
		
			$action = new Inclusive_CodeGenerator_Controller_Action($this,$name,$config);
			
			$objects[] = $action;
		
		}
		
		return $objects;
	
	}
	
	public function getClassName()
	{
	
		$name = $this->getModule()->getName().'_';
		
		$name .= $this->getName();
		
		$name .= 'Controller';
		
		return $name;
	
	}
	
	public function getModule()
	{
	
		return $this->_module;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function getService($key)
	{
		
		if (!isset($this->_services[$key]))
		{
		
			return false;
		
		}
		
		return $this->_services[$key];
		
	}
	
	public function getServices()
	{
	
		return $this->_services;
		
	}
	
	public function setActions(array $actions)
	{
	
		$this->_actions = array();
		
		foreach ($actions as $name => $config)
		{
		
			$this->addAction($name,$config);
		
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