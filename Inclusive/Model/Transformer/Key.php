<?php

class Inclusive_Model_Transformer_Key extends Inclusive_Model_Transformer_Abstract
{
	
	protected $_data = null;
	
	protected $_key = null;
	
	protected $_model = null;
	
	public function __construct(array $options=array())
	{
	
		if (isset($options['key']) && !empty($options['key']))
		{
		
			$this->_key = $options['key'];
		
		}
		else 
		{
		
			throw new Inclusive_Model_Transformer_Exception('key option must be set.');
		
		}
	
	}
	
	public function commit()
	{
	
		
	
	}
	
	public function isAllowed()
	{
		
		$acl = Zend_Registry::get('Acl');
		$roles = Zend_Registry::get('Roles');
		
		return $acl->isAllowed($roles,$this->_model,'set:'.$this->_key);
	
	}
	
	public function match(Inclusive_Model_Abstract $model,$data)
	{
	
		if (isset($data[$this->_key]))
		{
			
			$this->_model = $model;
			
			$this->_data = $data;
			
			return true;
		
		}
		
		return false;
	
	}
	
	public function rollback()
	{
	
		$this->_model->set($this->_key,$this->_model->getOriginal($this->_key));
	
	}
	
	public function transform()
	{
	
		$this->_model->set($this->_key,$this->_data[$this->_key]);
	
	}

}