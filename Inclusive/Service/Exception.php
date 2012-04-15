<?php

class Inclusive_Service_Exception extends Zend_Exception {

	protected $_messages = array();

	public function __construct(
		$msg = '',
		$code = 0,
		Exception $previous = null
		) {
	
		if (is_array($msg)) {
		
			$messages = $msg;
			
			$msg = $this->_getDefaultMessage($messages);
			
			$this->setMessages($messages);
		
		}
	
		parent::__construct($msg,$code,$previous);
		
	}
	
	public function addMessage($message) {
	
		$this->_messages[] = $message;
		
		return $this;
	
	}
	
	public function getMessages() {
	
		return $this->_messages;
	
	}
	
	public function setMessages(array $messages) {
	
		$this->_messages = $messages;
		
		return $this;
	
	}
	
	protected function _getDefaultMessage(array $messages) {
	
		if (!count($messages)) {
		
			return '';
		
		}
		
		foreach ($messages as $key => $value) {
		
			return $key;
		
		}
	
	}
	
}