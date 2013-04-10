<?php

class Inclusive_Event_Manager 
{

	protected static $_instance = null;
	
	protected $_listeners = array();
	
	protected $_queue = null;
	
	public function addListener(Inclusive_Event_Listener_Interface $listener)
	{
	
		$listener->setManager($this);
		
		$this->_listeners[] = $listener;
		
		return $this;
	
	}
	
	public function fetch()
	{
		
		return $this->getQueue()->fetch();
		
	}
	
	public static function getInstance() 
	{
		
        if (null === self::$_instance) 
        {
        	
            self::$_instance = new self();
        	
        }
		
        return self::$_instance;
        
    }
    
    public function getListeners()
    {
    
    	return $this->_listeners;
    
    }
    
    public function getQueue()
    {
    
    	if (null === $this->_queue)
    	{
    		
    		$this->_queue = new Inclusive_Event_Queue();
    		
    	}
    	
    	return $this->_queue;
    
    }
    
    public function queue($event,$context=null)
    {
    
    	$this->getQueue()->add($event,$context);
    	
    	return $this;
    
    }
    
    public function trigger($event,$context=null)
    {
    	
    	foreach ($this->getListeners() as $listener)
    	{
    	
    		$listener->process($event,$context);
    	
    	}
    	
    	return $this;
    
    }
    
}