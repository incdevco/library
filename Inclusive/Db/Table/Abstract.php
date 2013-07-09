<?php

abstract class Inclusive_Db_Table_Abstract extends Zend_Db_Table_Abstract 
{
	
	protected $_module = null;
	
	protected $_multiDb = null;
	
	protected $_primaryCreateUnique = false;
	
	protected $_salt = 'alkaOIJS:I()_%lkjasdfnh@#43232lkJShask;lk';
	
	public function createUniqueId($length=40) {
	
		return $this->_createUniqueId($length);
	
	}
	
	public function fetchEmpty() {
	
		$rowsetClass = $this->getRowsetClass();
		
		return new $rowsetClass(array(
			'table'=>$this,
			'rowClass'=>$this->getRowClass(),
			'stored'=>true
			));
	
	}
	
	public function getPrimaryKey() {
	
		return $this->_primary;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function insert(array $data)
	{
	
		if ($this->_primaryCreateUnique)
		{
		
			if (is_array($this->_primary))
			{
			
				if (count($this->_primary) != 1)
				{
				
					throw new Zend_Exception('Cannot Create Unique Multi-Key');
				
				}
				
				$key = $this->_primary[1];
				
			}
			else 
			{
			
				$key = $this->_primary;
			
			}
			
			if (empty($key))
			{
			
				throw new Zend_Exception('Primary Key Empty: '.$key);
			
			}
			
			if (!isset($data[$key]) or empty($data[$key]))
			{
			
				$length = intval($this->_primaryCreateUnique);
			
				$data[$key] = $this->_createUniqueId($length);
			
			}
		
		}
		
		return parent::insert($data);
	
	}
	
	public function service($name,$module=null) {
		
		if (!$module) {
			
			$module = $this->_module;
			
		}
		
		return Inclusive_Locator::service($name,$module);
		
	}
	
	protected function _setupDatabaseAdapter() {
		
		if ($this->_multiDb) {
			
			$multiDb = Zend_Controller_Front::getInstance()
				->getParam('bootstrap')->getResource('multidb');
			
			if ($multiDb) {
				
				$adapter = $multiDb->getDb($this->_multiDb);
				
				if ($adapter instanceof Zend_Db_Adapter_Abstract) {
					
					return $this->_db = $adapter;
					
				}
				
			}
			
		}
		
		return parent::_setupDatabaseAdapter();
		
	}
	
	protected function _createUniqueId($length=40) {
	
		while(true) {

			$lenth = (int) $length;
		
			$id = substr(md5(uniqid(rand(),true).$this->_createSalt()),0,$length);
			
			$row = $this->find($id);
			
			if (!$row->count()) {
			
				return $id;
			
			}
		
		}
	
	}
	
	protected function _createSalt()
	{
	
		return md5(uniqid(rand(),true).$this->_salt);
	
	}
	
}