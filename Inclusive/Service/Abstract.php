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
	
	public function buildSet($results,$privilege)
	{
	
		$set = $this->createSet();
		
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
	
		return $this->getAdapter()->createUniqueId($length);
	
	}
	
	abstract protected function _getAcl();
	
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
	
	abstract protected function _getRoles();
	
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
			
				return $this->_throw('Adapter must be instanceof Inclusive_Service_Adapter_Abstract not: '.get_class($adapter));
			
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
	
	public function isAllowed($model,$privilege)
	{
	
		$roles = $this->_getRoles();
		
		$acl = $this->_getAcl();
		
		$result = $acl->isAllowed($roles,$model,$privilege);
		
		return $this->_throwNotAllowed($model,$privilege);
		
	}
	
	public function isValid($form,$data)
	{
	
		if (is_string($form))
		{
		
			if (isset($this->_formClasses[$form]))
			{
			
				$form = new $this->_formClasses[$form]();
			
			}
			
			throw new Inclusive_Exception('_formClasses key '.$form.' is not set'); 
		
		}
		
		if ($form instanceof Inclusive_Form)
		{
		
			if ($form->isValid($data))
			{
			
				return $form->getValues();
			
			}
			
			return $this->_throwForm($form);
		
		}
		
		throw new Inclusive_Exception(strval($form).' is not an instance of Inclusive_Form');
	
	}
	
	protected function _add(array $data)
	{
		
		return $this->_magic('add',$data);
		
	}
	
	protected function _attach(array $data)
	{
	
		return $this->_magic('attach',$data);
	
	}
	
	protected function _delete(array $data)
	{
	
		return $this->_magic('delete',$data);
	
	}
	
	protected function _detach(array $data)
	{
	
		return $this->_magic('detach',$data);
	
	}
	
	protected function _edit(array $data)
	{
	
		return $this->_magic('edit',$data,true);
	
	}
	
	public function _fetchAll(array $data)
	{
		
		$clean = $this->isValid('FetchAll',$data);
		
		$results = $this->getAdapter()->fetchAll($clean);
		
		return $this->buildSet($results,'view');
		
	}
	
	protected function _fetchOne(array $data)
	{
		
		$clean = $this->isValid('FetchOne',$data);
		
		$result = $this->getAdapter()->fetchRow($clean);
		
		if ($result)
		{
			
			$model = $this->createModel($result);
				
			$this->isAllowed($model,'view');
			
			return $model;
			
		}
			
		return $this->_throw('Nothing Found');
		
	}
	
	protected function _magic($function,$data,$update=false)
	{
	
		$clean = $this->isValid(ucfirst($function),$data);
		
		$model = $this->createModel($clean);
		
		$this->isAllowed($model,$function);
		
		if ($update)
		{
			
			$where = $this->_where($clean);
			
			$result = $this->getAdapter()->$function($clean,$where);
		
		}
		else 
		{
		
			$result = $this->getAdapter()->$function($clean);
			
		}
		
		return $result;
	
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
	
	protected function _where($clean)
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
		
		return $where;
	
	}
	
}