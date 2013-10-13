<?php

abstract class Inclusive_Set_Abstract implements Iterator {
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	protected $_set = null;
	
	public function __construct(Inclusive_Service_Abstract $service,array $set=array())
	{
	
		$this->setService($service);
		
		foreach ($set as $model)
		{
		
			if (is_array($model))
			{
			
				$class = $this->getService()
					->getModelClass();
					
				$model = new $class(
					$this->getService(),
					$model
					);
			
			}
		
			$this->addModel($model);
		
		}
	
	}
	
	public function addModel($model)
	{
	
		if (is_array($model))
		{
				
			$model = $this->arrayToModel($model);
		
		}
		
		if ($model instanceof Inclusive_Model_Abstract)
		{
			
			$this->_set[] = $model;
			
			return $this;
			
		}
		
		throw new Inclusive_Service_Exception('Cannot add '.gettype($model).' as model');
		
	}
	
	public function arrayToModel(array $array)
	{
	
		$class = $this->getService()
			->getModelClass();
			
		return new $class($this->getService(),$array);
	
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
	
	public function setWithAcl($acl,$models,$privilege)
	{
	
		foreach ($models as $model)
		{
			
			if (is_array($model))
			{
			
				$model = $this->arrayToModel($model);
			
			}
			
			try 
			{
				
				$acl->isAllowed($model,$privilege);
				
				$this->addModel($model);
			
			}
			catch (Inclusive_Service_Exception_NotAllowed $e)
			{
			
				
			
			}
		
		}
		
		return $this;
		
	}
	
	public function count()
	{
	
		return count($this->_set);
	
	}

	// Iterator Functions
	
	protected $_pointer = 0;
	
	public function current()
	{
	
		return $this->_set[$this->_pointer];
	
	}
	
	public function key()
	{
	
		return $this->_pointer;
	
	}
	
	public function next()
	{
	
		$this->_pointer++;
	
	}
	
	public function rewind()
	{
	
		$this->_pointer = 0;
	
	}
	
	public function toArray()
	{
	
		$array = array();
		
		foreach ($this as $model)
		{
		
			$array[] = $model->toArray();
		
		}
		
		return $array;
	
	}
	
	public function valid()
	{
	
		return isset($this->_set[$this->_pointer]);
	
	}

}