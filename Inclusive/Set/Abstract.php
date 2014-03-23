<?php

abstract class Inclusive_Set_Abstract implements Iterator 
{
	
	protected $_service = null;
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	protected $_set = array();
	
	public function __construct(Inclusive_Service_Abstract $service=null,$data=null)
	{
		
		if ($service)
		{
		
			$this->setService($service);
		
		}
		
		if (is_object($data))
		{
		
			$data = $data->toArray();
		
		}
		
		if (is_array($data))
		{
			
			foreach ($data as $model)
			{
			
				$this->addModel($model);
			
			}
			
		}
		
	}
	
	public function addModel($model)
	{
	
		if (is_array($model))
		{
				
			$model = $this->arrayToModel($model);
		
		}
		
		$this->_set[] = $model;
			
		return $this;
		
	}
	
	public function arrayToModel(array $array)
	{
	
		return $this->getService()->createModel($array);
		
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
	
	public function toArray($full=false)
	{
	
		$array = array();
		
		foreach ($this as $model)
		{
		
			$array[] = $model->toArray($full);
		
		}
		
		return $array;
	
	}
	
	public function valid()
	{
	
		return isset($this->_set[$this->_pointer]);
	
	}

}