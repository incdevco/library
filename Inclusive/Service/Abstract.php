<?php

abstract class Inclusive_Service_Abstract
{
	
	protected $_adapter = null;
	
	protected $_adapterClass = null;
	
	protected $_forms = array();
	
	protected $_formMap = array();
	
	protected $_modelClass = null;
	
	protected $_setClass = null;
	
	public function __construct() 
	{
		
		
		
	}
	
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
	
		$class = $this->getModelClass();
		
		$model = new $class(array(
			'service'=>$this,
			'data'=>$data,
			'new'=>false
			));
			
		return $model;
	
	}
	
	public function createSet($data=null)
	{
	
		$class = $this->getSetClass();
		
		$set = new $class(array(
			'service'=>$this,
			'data'=>$data
			));
			
		return $set;
	
	}
	
	public function createUniqueId($length=10) 
	{
	
		return $this->getAdapter()->createUniqueId($length);
	
	}
	
	public function delete(Inclusive_Model_Abstract $model)
	{
	
		$result = $this->getAdapter()->delete($model->getPrimary());
		
		if ($result)
		{
		
			$model->deleted();
		
		}
		
		return $result;
	
	}
	
	public function fetchAll(array $data)
	{
	
		$clean = $this->isValid('FetchAll',$data);
		
		$results = $this->getAdapter()->fetchAll($clean);
		
		return $this->buildSet($results,'view');
	
	}
	
	public function fetchNew() 
	{
	
		$class = $this->_modelClass;
		
		return new $class(array(
			'service'=>$this,
			'new'=>true
			));
	
	}
	
	public function fetchOne(array $data)
	{
	
		$clean = $this->isValid('FetchOne',$data);
		
		$result = $this->getAdapter()->fetchOne($clean);
		
		if ($result)
		{
		
			$model = $this->createModel($result);
			
			$this->isAllowed($model,'view');
			
			return $model;
		
		}
		
		return $this->_throwNotFound($clean);
	
	}
	
	public function getAcl()
	{
	
		return Zend_Registry::get('Acl');
	
	}
	
	public function getForm($key)
	{
	
		if (!isset($this->_forms[$key]))
		{
		
			$class = $this->_formMap[$key];
			
			$this->_forms[$key] = new $class();
		
		}
		
		return $this->_forms[$key];
	
	}
	
	public function getRoles()
	{
	
		return Zend_Registry::get('Roles');
	
	}
	
	public function getAdapter() 
	{
	
		if (null === $this->_adapter)
		{
			
			$class = $this->_adapterClass;
			
			$this->setAdapter(new $class());
		
		}
		
		return $this->_adapter;
	
	}
	
	public function getModelClass()
	{
	
		return $this->_modelClass;
		
	}
	
	public function getSetClass()
	{
	
		return $this->_setClass;
		
	}
	
	public function insert(Inclusive_Model_Abstract $model)
	{
		
		$this->isAllowed($model,'add');
		
		$result = $this->getAdapter()->insert($model->toArray());
		
		if ($result)
		{
			
			$model->saved($result);
		
		}
		
		return $result;
		
	}
	
	public function isAllowed($resource,$privilege)
	{
	
		$acl = $this->getAcl();
		
		$roles = $this->getRoles();
		
		$result = $acl->isAllowed($roles,$resource,$privilege);
		
		if ($result)
		{
		
			return $result;
		
		}
		
		return $this->_throwNotAllowed($resource,$privilege);
		
	}
	
	public function isValid($key,$data)
	{
	
		$form = $this->getForm($key);
		
		$result = $form->isValid($data);
		
		if ($result)
		{
		
			return $form->getValues();
		
		}
		
		return $this->_throwForm($form);
	
	}
	
	public function setAdapter(Inclusive_Service_Adapter_Abstract $adapter) 
	{
		
		$this->_adapter = $adapter;
		
		return $this;
	
	}
	
	public function setForm($key,Inclusive_Form $form)
	{
	
		$this->_forms[$key] = $form;
		
		return $this;
	
	}
	
	public function setModelClass($class)
	{
	
		$this->_modelClass = $class;
		
		return $this;
		
	}
	
	public function setSetClass($class)
	{
	
		$this->_setClass = $class;
		
		return $this;
		
	}
	
	public function update(Inclusive_Model_Abstract $model)
	{
	
		$result = $this->getAdapter()->update($model->getPrimary(),$model->toArray());
		
		if ($result)
		{
		
			$model->saved();
			
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
	
	protected function _throwNotAllowed($resource,$privilege)
	{
	
		throw new Inclusive_Service_Exception_NotAllowed($resource,$privilege);
	
	}
	
	protected function _throwNotFound($data)
	{
	
		throw new Inclusive_Service_Exception_NotFound();
	
	}
	
}
