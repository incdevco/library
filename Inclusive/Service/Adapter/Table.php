<?php

abstract class Inclusive_Service_Adapter_Table extends Inclusive_Service_Adapter_Abstract 
{

	protected $_table = null;
	
	protected $_tableClass = null;
	
	public function arrayToWhere(array $array)
	{
	
		$where = array();
		
		foreach ($array as $key => $value)
		{
		
			$where["$key = ?"] = $value;
			
		}
		
		return $where;
	
	}
	
	public function insert(array $data)
	{
	
		return $this->getTable()->insert($data);
	
	}
	
	public function createUniqueId($length) 
	{
	
		return $this->getTable()->createUniqueId($length);
	
	}
	
	public function delete($data)
	{
		
		$where = $this->arrayToWhere($data);
		
		return $this->getTable()->delete($where);
	
	}
	
	public function fetchAll($data)
	{
		
		if (is_array($data))
		{
			
			$select = $this->select(true);
			
			foreach ($data as $key => $value)
			{
			
				if ($key != 'limit' && $key != 'offset')
				{
				
					$select->where("$key = ?",$value);
				
				}
			
			}
			
			if (!isset($data['limit']))
			{
			
				$data['limit'] = 50;
			
			}
			
			if (!isset($data['offset']))
			{
			
				$data['offset'] = 0;
			
			}
			
			$select->limit($data['limit'],$data['offset']);
			
		}
		else 
		{
		
			$select = $data;
		
		}
		
		return $this->getTable()->fetchAll($select);
	
	}
	
	public function fetchOne($where)
	{
		
		if (is_array($where))
		{
		
			$where = $this->arrayToWhere($where);
		
		}
		
		return $this->getTable()->fetchRow($where);
	
	}
	
	public function getTable() 
	{
		
		if (null === $this->_table)
		{
			
			$class = $this->_tableClass;
			
			$this->setTable(new $class());
			
		}
		
		return $this->_table;
	
	}
	
	public function getTableClass()
	{
	
		return $this->_tableClass;
		
	}
	
	public function primaryToWhere($data)
	{
	
		return array(
			'id = ?'=>$id
			);
	
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
	
	public function update($where,array $data)
	{
		
		$where = $this->arrayToWhere($where);
		
		return $this->getTable()->update($data,$where);
	
	}
	
}