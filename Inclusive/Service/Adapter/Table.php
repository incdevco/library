<?php

abstract class Inclusive_Service_Adapter_Table extends Inclusive_Service_Adapter_Abstract 
{

	protected $_table = null;
	
	protected $_tableClass = 'Inclusive_Db_Table';
	
	public function add(array $clean)
	{
	
		return $this->getTable()->insert($clean);
	
	}
	
	public function arrayToWhere(array $array)
	{
	
		$where = array();
		
		foreach ($array as $key => $value)
		{
		
			$where["`$key` = ?"] = $value;
			
		}
		
		return $where;
	
	}
	
	public function createUniqueId($length=10) 
	{
	
		return $this->getTable()
			->createUniqueId($length);
	
	}
	
	public function delete(array $clean)
	{
	
		$where = $this->arrayToWhere($clean);
		
		return $this->getTable()->delete($where);
	
	}
	
	public function edit(array $clean,array $where)
	{
	
		$where = $this->arrayToWhere($where);
		
		return $this->getTable()->update($clean,$where);
	
	}
	
	public function fetchAll($where=null)
	{
		
		if (is_array($where))
		{
		
			$where = $this->arrayToWhere($where);
			
		}
		
		return $this->getTable()->fetchAll($where);
	
	}
	
	public function fetchOne($where=null)
	{
		
		if (is_array($where))
		{
		
			$where = $this->arrayToWhere($where);
			
		}
		
		return $this->getTable()->getAdapter()->fetchOne($where);
	
	}
	
	public function fetchRow($where=null)
	{
		
		if (is_array($where))
		{
		
			$where = $this->arrayToWhere($where);
			
		}
		
		return $this->getTable()->fetchRow($where);
	
	}
	
	public function getTable() 
	{
	
		$class = $this->_tableClass;
	
		if (!($this->_table instanceof $class))
		{
		
			$this->setTable(new $class());
		
		}
		
		return $this->_table;
	
	}
	
	public function getTableClass()
	{
	
		return $this->_tableClass;
		
	}
	
	public function select($withFrom=false)
	{
	
		return $this->getTable()->select($withFrom);
	
	}
	
	public function setTable(Inclusive_Db_Table_Abstract $table) 
	{
	
		$this->_table = $table;
		
		return $this;
	
	}
	
}