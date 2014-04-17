<?php

abstract class Inclusive_Model_Abstract implements Zend_Acl_Resource_Interface
{
	
	protected $_data = array();
	
	protected $_dirty = array();
	
	protected $_form = null;
	
	protected $_formClass = null;
	
	protected $_original = array();
	
	protected $_required = array();
	
	protected $_service = null;
	
	protected $_stored = false;
	
	public function __construct(array $config=array()) 
	{
		
		if (isset($config['data']))
		{
			
			if (is_object($config['data']))
			{
			
				$config['data'] = $config['data']->toArray();
			
			}
			
			$this->_original = $config['data'];
			
			$this->_data = $this->_original;
			
			$this->_dirty = $this->_data;
			
		}
		
		if (isset($config['service']))
		{
		
			$this->setService($config['service']);
		
		}
	
		if (isset($config['stored']))
		{
		
			$this->_stored = ($config['stored']) ? true : false;
		
		}
	
	}
	
	public function deleted()
	{
		
		return $this;
	
	}
	
	public function get($key)
	{
	
		if ($this->isAllowed('get:'.$key))
		{
			
			$fn = $this->_keyToFunction('_get',$key);
			
			if (method_exists($this,$fn))
			{
			
				return $this->$fn();
			
			}
			else 
			{
			
				return $this->_data[$key];
			
			}
			
		}
		
		return null;
	
	}
	
	public function getAcl()
	{
	
		return Zend_Registry::get('Acl');
	
	}
	
	public function getDirty()
	{
	
		return $this->_dirty;
	
	}
	
	public function getForm()
	{
		
		if (null === $this->_form)
		{
		
			$class = $this->_formClass;
			
			$this->_form = new $class();
		
		}
		
		return $this->_form;
	
	}
	
	public function getOriginal($key=null)
	{
		
		if ($key)
		{
		
			return $this->_original[$key];
		
		}
		
		return $this->_original;
	
	}
	
	public function getPrimary()
	{
	
		$primary = array();
		
		$keys = $this->getService()->getAdapter()->getTable()->getPrimaryKey();
		
		foreach ($keys as $key)
		{
		
			$primary[$key] = $this->$key;
		
		}
		
		return $primary;
	
	}
	
	public function getRoles()
	{
	
		return Zend_Registry::get('Roles');
	
	}
	
	public function getResourceId()
	{
	
		return get_class($this);
	
	}
	
	public function getService($key=null) 
	{
		
		return $this->_service;
		
	}
	
	public function isAllowed()
	{
	
		$acl = $this->getAcl();
		
		$roles = $this->getRoles();
		
		foreach ($this->_required as $privilege)
		{
		
			$result = $acl->isAllowed($roles,$this,'set:'.$privilege);
			
			if (!$result)
			{
			
				return $this->_throwNotAllowed($privilege);
			
			}
			
		}
		
		return true;
		
	}
	
	public function isStored()
	{
	
		return $this->_stored;
		
	}
	
	public function isValid()
	{
	
		$form = $this->getForm();
		
		$result = $form->isValid($this->getDirty());
		
		if ($result)
		{
		
			return $form->getValues();
		
		}
		
		return $this->_throwNotValid($form);
	
	}
	
	public function save() 
	{
		
		$clean = $this->isValid();
		
		$this->isAllowed();
		
		foreach ($clean as $key => $value) 
		{
		
			$this->_data[$key] = $value;
		
		}
		
		$this->getService()->save($this);
		
		return $this;
	
	}
	
	public function saved()
	{
		
		return $this;
	
	}
	
	public function set($key,$value)
	{
	
		$this->_dirty[$key] = $value;
		
		$this->_required[] = $key;
		
		return $this;
		
	}
	
	public function setForm(Inclusive_Form $form)
	{
	
		$this->_form = $form;
		
		return $this;
	
	}
	
	public function setFromArray(array $data) 
	{
	
		foreach ($data as $key => $value) 
		{
		
			$this->set($key,$value);
		
		}
		
		return $this;
	
	}
	
	public function setService(Inclusive_Service_Abstract $service) 
	{
		
		$this->_service = $service;
		
		return $this;
	
	}
	
	public function stored($id)
	{
		
		$this->_stored = true;
		
		$this->_data['id'] = $id;
		
		return $this;
	
	}
	
	public function toArray() 
	{
	
		return $this->_data;
	
	}
	
	public function toJson($returnArray=false)
	{
	
		$array = $this->toArray();
		
		if ($returnArray)
		{
		
			return $array;
		
		}
		
		return Zend_Json::encode($array);
	
	}
	
	public function __get($key) 
	{
	
		return $this->get($key);
	
	}
	
	public function __isset($key)
	{
	
		return isset($this->_data[$key]);
	
	}
	
	public function __set($key,$value) 
	{
	
		return $this->set($key,$value);
		
	}
	
	protected function _keyToFunction($type,$key)
	{
	
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
		
		return '_'.$type.$filter->filter($key);
	
	}
	
	protected function _throwNotAllowed($privilege)
	{
	
		throw new Inclusive_Model_Exception_NotAllowed($this,$privilege);
	
	}
	
	protected function _throwNotValid($form)
	{
	
		throw new Inclusive_Model_Exception_NotValid($this,$form);
	
	}
	
}