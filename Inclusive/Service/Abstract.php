<?php

abstract class Inclusive_Service_Abstract implements Inclusive_Service_Acl_Resource_Interface
{
	
	protected $_acl = null;
	
	protected $_aclContext = null;
	
	protected $_aclRoles = null;
	
	protected $_adapter = null;
	
	protected $_adapterClass = null;
	
	protected $_forms = array();
	
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
	
	public function fetchNew() 
	{
	
		$class = $this->_modelClass;
		
		return new $class($this);
	
	}
	
	public function getAcl()
	{
	
		if ($this->_acl === null)
		{
		
			$this->_acl = Zend_Registry::get('acl');
		
		}
		
		return $this->_acl;
	
	}
	
	public function getAclContext()
	{
	
		if ($this->_aclContext === null)
		{
		
			$this->_aclContext = Zend_Registry::get('aclContext');
		
		}
		
		return $this->_aclContext;
	
	}
	
	public function getAclRoles()
	{
	
		if ($this->_aclRoles === null)
		{
		
			$this->_aclRoles = Zend_Registry::get('aclRoles');
		
		}
		
		return $this->_aclRoles;
	
	}
	
	public function getAdapter() 
	{
	
		if ($this->_adapter === null)
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
	
		if ($new
			or !isset($this->_forms[$key]))
		{
		
			$class = $this->getFormClass($key);
		
			$this->setForm($key,new $class());
			
		}
		
		return $this->_forms[$key];
	
	}
	
	public function getFormClass($key)
	{
	
		if (isset($this->_formClasses[$key]))
		{
		
			return $this->_formClasses[$key];
		
		}
		
		throw new Inclusive_Service_Exception(
			'No Class Found For: '.$key
			);
			
	}
	
	public function getModelClass()
	{
	
		return $this->_modelClass;
		
	}
	
	public function getResourceId()
	{
	
		return get_class($this);
	
	}
	
	public function getService($key=null) 
	{
	
		if ($key != null 
			&& isset($this->_serviceClasses[$key]))
		{
		
			$class = $this->_serviceClasses[$key];
		
		}
		else 
		{
		
			$class = $key;
		
		}
	
		if ($class != null)
		{
		
			if (!isset($this->_services[$key])
				or !($this->_services[$key] instanceof $class))
			{
			
				$this->setService(new $class(),$key);
			
			}
			
			return $this->_services[$key];
		
		}
	
		return $this->_throw('No Service Found');
	
	}
	
	public function getSetClass()
	{
	
		return $this->_setClass;
		
	}
	
	public function setAcl(Zend_Acl $acl)
	{
	
		$this->_acl = $acl;
		
		return $this;
	
	}
	
	public function setAclContext($context)
	{
	
		$this->_aclContext = $context;
		
		return $this;
	
	}
	
	public function setAclRoles($roles)
	{
	
		$this->_aclRoles = $roles;
		
		return $this;
	
	}
	
	public function setAdapter($adapter) 
	{
		
		if (is_string($adapter))
		{
		
			$adapter = new $adapter($this);
		
		}
		else 
		{
		
			if ($adapter instanceof Inclusive_Service_Adapter_Abstract)
			{
			
				$adapter->setService($this);
				
			}
			else 
			{
			
				return $this->_throw('Adapter must be instanceof Inclusive_Service_Adapter_Abstract');
			
			}
	
		}
		
		$this->_adapter = $adapter;
		
		return $this;
	
	}
	
	public function setForm($key,Zend_Form $form)
	{
	
		$this->_forms[$key] = $form;
		
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
	
		if ($key != null)
		{
		
			$this->_services[$key] = $service;
			
			return $this;
		
		}
	
		$this->_service = $service;
		
		return $this;
	
	}
	
	public function setSetClass($class)
	{
	
		$this->_setClass = $class;
		
		return $this;
		
	}
	
	public function isAllowed($privilege,$context=null)
	{
	
		$acl = $this->getAcl();
		
		$roles = $this->getAclRoles();
		
		$this->setAclContext($context);
		
		return $acl->isAllowed($roles,$this,$privilege);
		
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