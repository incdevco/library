<?php

abstract class Inclusive_Set_Abstract implements Iterator 
{
	
	protected $_service = null;
	
	protected $_set = null;
	
	public function __construct(array $config=array())
	{
		
		if (isset($config['service']))
		{
		
			$this->setService($config['service']);
			
		}
		
		if (isset($config['data']))
		{
			
			foreach ($set as $model)
			{
			
				$this->addModel($model);
			
			}
			
		}
	
	}
	
	public function addModel($model)
	{
	
		if (is_array($model))
		{
		
			$model = $this->getService()->createModel($model);
			
		}
			
		$this->_set[] = $model;
		
		return $this;
		
	}
	
	public function getService($key=null) 
	{
	
		return $this->_service;
	
	}
	
	public function setService(Inclusive_Service_Abstract $service) 
	{
		
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
	
	public function toArray()
	{
	
		$array = array();
		
		foreach ($this as $model)
		{
		
			$array[] = $model->toArray();
		
		}
		
		return $array;
	
	}
	
	public function toJson()
	{
	
		$array = array();
		
		foreach ($this as $model)
		{
		
			$array[] = $model->toJson(true);
		
		}
		
		return Zend_Json::encode($array);
	
	}
	
	public function valid()
	{
	
		return isset($this->_set[$this->_pointer]);
	
	}

}