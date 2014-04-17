<?php

abstract class Inclusive_Db_Table_Abstract extends Zend_Db_Table_Abstract 
{
	
	protected $_primaryCreateUnique = false;
	
	public function createUniqueId($length) 
	{
	
		while(true) {
		
			$length = (int) $length;
		
			$id = substr(md5(uniqid(rand(),true)),0,$length);
			
			$row = $this->find($id);
			
			if (!$row->count()) {
			
				return $id;
			
			}
		
		}
	
	}
	
	public function getPrimaryKey() 
	{
		
		$this->_setupPrimaryKey();
		
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
			
			$primary = $this->getPrimaryKey();
			
			$key = array_shift($primary);
			
			if (!isset($data[$key]) or empty($data[$key]))
			{
			
				$length = intval($this->_primaryCreateUnique);
			
				$data[$key] = $this->createUniqueId($length);
			
			}
		
		}
		
		return parent::insert($data);
	
	}
	
}