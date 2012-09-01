<?php

class Inclusive_Service_Adapter_Email
	extends Inclusive_Service_Adapter_Abstract
{

	protected $_account = null;
	
	protected $_accountClass = 'Zend_Mail_Storage_Pop3';
	
	protected $_accountSettings = array();
	
	public function getAccount()
	{
	
		if (!($this->_account 
			instanceof Zend_Mail_Storage_Abstract))
		{
		
			$class = $this->getAccountClass();
		
			$this->setAccount(new $class(
				$this->_accountSettings
				));
		
		}
		
		return $this->_account;
	
	}
	
	public function getAccountClass()
	{
	
		return $this->_accountClass;
		
	}
	
	public function getEmails()
	{
	
		$list = $this->getAccount()->getSize();
		
		$emails = array();
		
		foreach ($list as $id => $size)
		{
		
			$emails[] = $this->getAccount()->getById($id);
		
		}
		
		return $emails;
	
	}
	
	public function setAccount(
		Zend_Mail_Storage_Abstract $account
	)
	{
	
		$this->_account = $account;
		
		return $this;
	
	}

}