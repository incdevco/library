<?php

abstract class Inclusive_Service_Adapter_Abstract 
{
	
	public function __construct(array $config=array()) 
	{
		
		
		
	}
	
	abstract public function insert(array $data);
	
	abstract public function createUniqueId($length);
	
	abstract public function delete($id);
	
	abstract public function fetchAll($data);
	
	abstract public function fetchOne($id);
	
	abstract public function select($withFrom=false);
	
	abstract public function update($id,array $data);
	
	protected function _throw($message)
	{
	
		throw new Inclusive_Service_Adapter_Exception($message);
	
	}
	
}