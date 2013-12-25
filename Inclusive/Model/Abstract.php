<?php

abstract class Inclusive_Model_Abstract implements Zend_Acl_Resource_Interface
{

	protected $_data = array();
	
	protected $_new = array();

	protected $_service = null;
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	public function __construct(Inclusive_Service_Abstract $service,$data=array()) 
	{
		
		$this->setService($service);
		
		if ($data instanceof Zend_Db_Table_Row_Abstract)
		{
		
			$data = $data->toArray();
		
		}
		
		$this->_data = $data;
	
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
	
		return $this->_service;
	
	}
	
	public function isAllowed($privilege)
	{
	
		$acl = Zend_Registry::get('acl');
		
		$roles = Zend_Registry::get('aclRoles');
		
		if ($acl->isAllowed($roles,$this,$privilege))
		{
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function save() 
	{
	
		if ($this->_isNew()) {
		
			$this->getService()
				->add($this->toArray());
		
		} else {
		
			$this->getService()
				->edit($this->toArray());
		
		}
		
		return $this;
	
	}
	
	public function set($key,$value) 
	{
	
		$this->_new[$key] = $value;
		
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
	
	public function toArray() 
	{
	
		return array_merge($this->_data,$this->_new);
	
	}
	
	protected function _isNew() 
	{
	
		if (empty($this->_data)) 
		{
		
			return true;
			
		}
		
		return false;
	
	}
	
	public function __get($key) 
	{
	
		$array = $this->toArray();
		
		if (!isset($array[$key])) 
		{
		
			return null;
		
		}
		
		return $array[$key];
	
	}
	
	public function __set($key,$value) 
	{
	
		$this->set($key,$value);
		
		return $this;
	
	}

}