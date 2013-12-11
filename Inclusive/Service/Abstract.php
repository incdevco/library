<?php

abstract class Inclusive_Service_Abstract implements Inclusive_Service_Acl_Resource_Interface
{
	
	protected $__acl = null;
	
	protected $__aclClass = null;
	
	protected $__adapter = null;
	
	protected $_adapterClass = null;
	
	protected $__forms = array();
	
	protected $_formClasses = array();
	
	protected $_modelClass = null;
	
	protected $_setClass = null;
	
	protected $_service = null;
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	public function __construct() 
	{
		
		
		
	}
	
	public function createUniqueId($length=10) 
	{
	
		return $this->getAdapter()
			->createUniqueId($length);
	
	}
	
	public function createModel($data,$privilege=null)
	{
		
		$class = $this->getModelClass();
		
		$model = new $class($this,$data);
		
		if (null !== $privilege)
		{
		
			$this->getAcl()->isAllowed($model,$privilege);
		
		}
		
		return $model;
	
	}
	
	public function createSet($datas,$privilege=null)
	{
	
		$class = $this->getSetClass();
		
		$set = new $class($this);
		
		foreach ($datas as $data)
		{
		
			try 
			{
			
				$model = $this->createModel($data,$privilege);
				
				$set->addModel($model);
			
			}
			catch (Inclusive_Service_Exception $e)
			{
			
				
			
			}
		
		}
		
		return $set;
	
	}
	
	public function fetchNew(array $data=array()) 
	{
	
		$class = $this->_modelClass;
		
		return new $class($this,$data);
	
	}
	
	public function getAcl()
	{
	
		if ($this->__acl === null)
		{
			
			$class = $this->__aclClass;
			
			$this->__acl = new $class();
		
		}
		
		return $this->_acl;
	
	}
	
	public function getAdapter() 
	{
	
		if ($this->__adapter === null)
		{
		
			if ($this->_adapterClass === null)
			{
			
				$this->_throw('No Adapter Class Set');
			
			}
			
			$this->setAdapter($this->_adapterClass);
		
		}
		
		return $this->_adapter;
	
	}
	
	public function getForm($key,$new=false)
	{
	
		if ($new || !isset($this->__forms[$key]))
		{
		
			$class = $this->getFormClass($key);
		
			$this->setForm($key,new $class());
			
		}
		
		return $this->__forms[$key];
	
	}
	
	public function getFormClass($key)
	{
	
		if (isset($this->_formClasses[$key]))
		{
		
			return $this->_formClasses[$key];
		
		}
		
		return $this->_throw('No Class Found For: '.$key);
			
	}
	
	public function getModelClass()
	{
	
		return $this->_modelClass;
		
	}
	
	public function getService($key=null) 
	{
	
		if ($key != null && isset($this->_serviceClasses[$key]))
		{
		
			$class = $this->_serviceClasses[$key];
		
		}
		else 
		{
		
			$class = $key;
		
		}
	
		if ($class != null)
		{
		
			if (!isset($this->__services[$key])
				|| !($this->__services[$key] instanceof $class))
			{
			
				$this->setService(new $class(),$key);
			
			}
			
			return $this->__services[$key];
		
		}
	
		return $this->_throw('No Service Found: '.$key);
	
	}
	
	public function getSetClass()
	{
	
		return $this->_setClass;
		
	}
	
	public function setAcl(Zend_Acl $acl)
	{
	
		$this->__acl = $acl;
		
		return $this;
	
	}
	
	public function setAdapter($adapter) 
	{
		
		if (is_string($adapter))
		{
		
			$adapter = new $adapter(array('service'=>$this));
		
		}
		else 
		{
		
			if (!($adapter instanceof Inclusive_Service_Adapter_Abstract))
			{
			
				return $this->_throw('Adapter must be instanceof Inclusive_Service_Adapter_Abstract');
			
			}
	
		}
		
		$this->__adapter = $adapter;
		
		$adapter->setService($this);
		
		return $this;
	
	}
	
	public function setForm($key,Zend_Form $form)
	{
	
		$this->__forms[$key] = $form;
		
		return $this;
	
	}
	
	public function setFormClass($key,$class)
	{
	
		$this->_formClasses[$key] = $class;
		
		return $this;
	
	}
	
	public function setModelClass($class)
	{
	
		$this->_modelClass = $class;
		
		return $this;
		
	}
	
	public function setService(Inclusive_Service_Abstract $service,$key=null) 
	{
	
		if (null === $key)
		{
			
			$this->__service = $service;
			
		}
		else 
		{
			
			$this->__services[$key] = $service;
			
		}
		
		return $this;
	
	}
	
	public function setSetClass($class)
	{
	
		$this->_setClass = $class;
		
		return $this;
		
	}
	
	public function _throw($message)
	{
	
		throw new Inclusive_Service_Exception($message);
	
	}
	
	public function _throwForm(Zend_Form $form)
	{
	
		throw new Inclusive_Service_Exception_Form($form);
	
	}
	
}