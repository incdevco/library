<?php

abstract class Inclusive_Event_Listener_Abstract implements Inclusive_Event_Listener_Interface
{
	
	protected $_manager = null;
	
	public function getManager()
	{
	
		return $this->_manager;
	
	}
	
	abstract function process($event,$context=null);
	
	public function setManager(Inclusive_Event_Manger $manager)
	{
	
		$this->_manager = $manager;
		
		return $this;
	
	}
	
}