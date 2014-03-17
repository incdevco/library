<?php

class Inclusive_Acl extends Zend_Acl 
{
	
	protected $_context = null;
	
	public function getContext()
	{
	
		return $this->_context;
	
	}
	
	public function isAllowed($role=null,$resource=null,$privilege=null)
	{
	
		$allowed = false;
		
		if (is_string($role) || $role === null)
		{
		
			$role = array($role);
		
		}
		
		$roles = $role;
	
		foreach ($roles as $role)
		{
		
			if (parent::isAllowed($role,$resource,$privilege))
			{
				
				return true;
			
			}
		
		}
	
		return $allowed;
	
	}
	
	public function setContext($context)
	{
	
		$this->_context = $context;
		
		return $this;
	
	}
	
}