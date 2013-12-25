<?php

class Inclusive_Service_Acl_Abstract
{

	protected $_acl = null;
	
	public function __construct()
	{
	
		$this->_acl = new Inclusive_Acl();
		
		$this->init();
	
	}
	
	public function init()
	{
	
	
	
	}
	
	public function addResource($resource)
	{
	
		$this->_acl->addResource($resource);
		
		return $this;
	
	}
	
	public function addRole($role)
	{
	
		$this->_acl->addRole($role);
		
		return $this;
	
	}
	
	public function allow($role=null,$resource=null,$privilege=null)
	{
		
		$this->_acl->allow($role,$resource,$privilege);
		
		return $this;
		
	}
	
	public function deny($role=null,$resource=null,$privilege=null)
	{
		
		$this->_acl->deny($role,$resource,$privilege);
		
		return $this;
		
	}
	
}