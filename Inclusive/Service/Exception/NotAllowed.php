<?php

class Inclusive_Service_Exception_NotAllowed extends Inclusive_Service_Exception 
{
	
	protected $_model = null;
	
	protected $_privilege = null;
	
	public function __construct($msg='',$code=0,Exception $previous=null) 
	{
		
		if ($msg instanceof Inclusive_Model_Abstract)
		{
			
			$this->setModel($msg);
			
		}
		
		if (is_string($code))
		{
			
			$this->setPrivilege($msg);
			
		}
		
		$msg = $this->createMessage($msg,$code);
	
		parent::__construct($msg,$code,$previous);
	
	}
	
	public function createMessage($model,$privilege)
	{
	
		$message = 'Not Allowed To '.$privilege.' On '.$model->getResourceId();
		
		return $message;
	
	}
	
	public function getModel() 
	{
	
		return $this->_model;
		
	}
	
	public function setModel(Inclusive_Model_Abstract $model) 
	{
	
		$this->_model = $model;
		
		return $this;
	
	}	
	
	public function getPrivilege() 
	{
	
		return $this->_model;
		
	}
	
	public function setPrivilege($privilege) 
	{
	
		$this->_privilege = $privilege;
		
		return $this;
	
	}	
	
}