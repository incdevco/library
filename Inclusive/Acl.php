<?php

class Inclusive_Acl extends Zend_Acl 
{
	
	public function isAllowed($role=null,$resource=null,$privilege=null)
	{
	
		if (!is_array($role))
		{
		
			$role = array($role);
		
		}
		
		$roles = $role;
	
		foreach ($roles as $role)
		{
			
			$result = parent::isAllowed($role,$resource,$privilege);
			
			if ($result)
			{
			
				return true;
			
			}
		
		}
		
		return parent::isAllowed(null,$resource,$privilege);
		
	}
	
}