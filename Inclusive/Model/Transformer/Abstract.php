<?php

abstract class Inclusive_Model_Transformer_Abstract
{
	
	protected $_form = null;
	
	protected $_formClass = null;
	
	protected $_model = null;
	
	protected $_privilege = null;
	
	protected $_serviceMap = array();
	
	protected $_services = array();
	
	abstract public function commit(Inclusive_Model_Abstract $model);
	
	public function getForm()
	{
	
		if (null === $this->_form)
		{
			
			$class = $this->_formClass;
			
			$this->_form = new $class();
			
		}
		
		return $this->_form;
	
	}
	
	public function getService($key)
	{
	
		if (!isset($this->_services[$key]))
		{
		
			$class = $this->_serviceMap[$key];
			
			$this->_services[$key] = Inclusive_Locator::service($class);
		
		}
		
		return $this->_services[$key];
	
	}
	
	public function isAllowed($return=false)
	{
	
		if (null === $this->_privilege)
		{
		
			return true;
		
		}
		
		$privileges = $this->_privilege;
		
		if (is_string($privileges))
		{
		
			$privileges = array($privileges);
		
		}
		
		$acl = Zend_Registry::get('Acl');
		
		$roles = Zend_Registry::get('Roles');
		
		foreach ($privileges as $privilege)
		{
		
			if (!$acl->isAllowed($roles,$this->_model,$privilege))
			{
			
				if ($return)
				{
				
					return false;
				
				}
				
				return $this->_throwNotAllowed($roles,$privilege);
				
			}
		
		}
		
		return true;
	
	}
	
	public function isValid($data,$return=false) 
	{
	
		$form = $this->getForm();
		
		if ($form->isValid($data))
		{
		
			return $form->getValues();
		
		}
		
		if ($return)
		{
		
			return false;
		
		}
		
		return $this->_throwForm($form);
		
	}
	
	abstract public function match(Inclusive_Model_Abstract $model,$data);
	
	abstract public function rollback(Inclusive_Model_Abstract $model);
	
	public function setForm(Inclusive_Form $form)
	{
	
		$this->_form = $form;
		
		return $this;
	
	}
	
	abstract public function transform(Inclusive_Model_Abstract $model,$data);
	
	protected function _throwForm(Inclusive_Form $form)
	{
	
		throw new Inclusive_Model_Exception_NotValid($this->_model,$form);
	
	}
	
	protected function _throwNotAllowed($roles,$privilege)
	{
	
		throw new Inclusive_Model_Exception_NotAllowed($this->_model,$roles,$privilege);
	
	}
	
}