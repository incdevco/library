<?php

class Inclusive_Event_Queue_Adapter_File implements Inclusive_Event_Queue_Adapter_Interface
{
	
	protected $_fileName = null;
	
	public function __construct($fileName)
	{
	
		$this->setFileName($fileName);
	
	}
	
	public function activate()
	{
	
	
	
	}
	
	public function add()
	{
	
	
	
	}
	
	public function delete()
	{
	
	
	
	}
	
	public function expire()
	{
	
	
	
	}
	
	public function fetch()
	{
	
	
	
	}
	
	public function getFileName()
	{
	
		return $this->_fileName;
	
	}
	
	public function setFileName($fileName)
	{
	
		$this->_fileName = $fileName;
		
		return $this;
	
	}
	
	public function wait()
	{
	
	
	
	}
	
}