<?php

class Inclusive_Service_Adapter_Mail
	extends Inclusive_Service_Adapter_Abstract
{

	protected $_mail = null;
	
	protected $_mailClass = 'Zend_Mail_Storage_Pop3';
	
	protected $_messageClass = null;
	
	protected $_mailSettings = array();
	
	/**
	*	returns the storage class, 
	*   which is iterable to get all messages
	*/
	public function getMail()
	{
	
		if (!($this->_mail 
			instanceof Zend_Mail_Storage_Abstract))
		{
		
			$class = $this->getMailClass();
		
			$this->setMail(new $class(
				$this->_mailSettings
				));
		
		}
		
		return $this->_mail;
	
	}
	
	public function getMailClass()
	{
	
		return $this->_mailClass;
		
	}
	
	public function getMessages()
	{
	
		$class = $this->getMessageClass();
		
		$mail = $ths->getMail();
		
		if ($class)
		{
		
			$messages = array();
			
			foreach ($mail as $message)
			{
			
				$messages[] = new $class($message);
			
			}
		
		}
		else 
		{
		
			$messages = $mail;
		
		}
		
		return $messages;
	
	}
	
	public function getMessageClass()
	{
	
		return $this->_messageClass;
	
	}
	
	public function setMail(
		Zend_Mail_Storage_Abstract $mail
	)
	{
	
		$this->_mail = $mail;
		
		return $this;
	
	}

}