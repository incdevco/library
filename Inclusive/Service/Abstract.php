<?php

abstract class Inclusive_Service_Abstract
{
	
	protected $_adapter = null;
	
	protected $_adapterClass = null;
	
	protected $_forms = array();
	
	protected $_formClasses = array();
	
	protected $_modelClass = null;
	
	protected $_primary = null;
	
	protected $_setClass = null;
	
	protected $_service = null;
	
	protected $_services = array();
	
	protected $_serviceClasses = array();
	
	public function createModel($data=null)
	{
		
		$class = $this->_modelClass;
		
		$model = new $class($this,$data);
		
		return $model;
	
	}
	
	public function createSet($data=null)
	{
	
		$class = $this->_setClass;
		
		$set = new $class($this,$data);
		
		return $set;
	
	}
	
	public function createUniqueId($length=10) 
	{
	
		return $this->getAdapter()
			->createUniqueId($length);
	
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
		
		$this->_adapter = $adapter;
		
		$adapter->setService($this);
		
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
	
	abstract public function isAllowed($model,$privilege);
	
	protected function _add(array $data)
	{
	
		$form = $this->getForm('Add');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			$model = $this->createModel($clean);
			
			$privilege = 'add';
			
			if ($this->isAllowed($model,$privilege))
			{
			
				return $this->getAdapter()->add($clean);
			
			}
			
			return $this->_throwNotAllowed($model,$privilege);
		
		}
		
		return $this->_throwForm($form);
	
	}
	
	protected function _delete(array $data)
	{
	
		$form = $this->getForm('Delete');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			$model = $this->fetchOne($clean);
			
			$privilege = 'delete';
			
			if ($this->isAllowed($model,$privilege))
			{
			
				return $this->getAdapter()->delete($clean);
			
			}
			
			return $this->_throwNotAllowed($model,$privilege);
		
		}
		
		return $this->_throwForm($form);
	
	}
	
	protected function _edit(array $data)
	{
	
		$form = $this->getForm('Edit');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			$model = $this->fetchOne($clean);
			
			$privilege = 'edit';
			
			if ($this->isAllowed($model,$privilege))
			{
				
				$primary = $this->_primary;
				
				if (!is_array($primary))
				{
				
					$primary = array($primary);
				
				}
				
				$where = array();
				
				foreach ($primary as $key)
				{
				
					$where[$key] = $clean[$key];
					
					unset($clean[$key]);
				
				}
				
				return $this->getAdapter()->edit($clean,$where);
			
			}
			
			return $this->_throwNotAllowed($model,$privilege);
		
		}
		
		return $this->_throwForm($form);
	
	}
	
	public function _fetchAll(array $data)
	{
	
		$form = $this->getForm('FetchAll');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			$results = $this->getAdapter()->fetchAll($clean);
			
			$set = $this->createSet();
			
			$privilege = 'view';
			
			foreach ($results as $result)
			{
			
				$model = $this->createModel($result);
				
				if ($this->isAllowed($model,$privilege))
				{
				
					$set->addModel($model);
				
				}
			
			}
			
			return $set;
		
		}
		
		return $this->_throwForm($form);
	
	}
	
	protected function _fetchOne(array $data)
	{
	
		$form = $this->getForm('FetchOne');
		
		if ($form->isValid($data))
		{
		
			$clean = $form->getValues();
			
			$result = $this->getAdapter()->fetchRow($clean);
			
			if ($result)
			{
			
				$model = $this->createModel($result);
				
				$privilege = 'view';
				
				if ($this->isAllowed($model,$privilege))
				{
				
					return $model;
				
				}
				
				return $this->_throwNotAllowed($model,$privilege);
			
			}
			
			return $this->_throw('No Model Found');
		
		}
		
		return $this->_throwForm($form);
	
	}
	
	protected function _throw($message)
	{
	
		throw new Inclusive_Service_Exception($message);
	
	}
	
	protected function _throwForm(Zend_Form $form)
	{
	
		throw new Inclusive_Service_Exception_Form($form);
	
	}
	
	protected function _throwNotAllowed($model,$privilege)
	{
	
		throw new Inclusive_Service_Exception_NotAllowed($model,$privilege);
	
	}
	
}