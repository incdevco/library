<?php

class Inclusive_Acl extends Zend_Acl 
{
	
	public function isAllowed($role=null,$resource=null,$privilege=null)
	{
	
		$allowed = false;
		
		if (!is_array($role))
		{
		
			$role = array($role);
		
		}
		
		$roles = $role;
	
		foreach ($roles as $role)
		{
		
			if (parent::isAllowed($role,$resource,$privilege))
			{
			
				$allowed = true;
			
			}
		
		}
	
		return $allowed;
	
	}
	
}