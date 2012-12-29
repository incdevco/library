<?php

interface Inclusive_Service_Acl_Resource_Interface extends Zend_Acl_Resource_Interface
{

	public function getAclContext();
	
	public function setAclContext($context);

}