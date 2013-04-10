<?php

class Inclusive_Event implements Inclusive_Event_Interface
{
	
	protected $_active = null;
	
	protected $_context = null;
	
	protected $_expires = null;
	
	protected $_finished = null;
	
	protected $_id = null;
	
	protected $_manager = null;
	
	protected $_name = null;
	
	protected $_started = null;
	
	public function __construct(Inclusive_Event_Manager $manager,array $data)
	{
		
		$this->setManager($manager);
		
		$this->setId($data['id']);
		
		if (isset($data['content']))
		{
			
			$this->setContext($data['context']);
		
		}
		
		if (isset($data['active']))
		{
			
			$this->setActive($data['active']);
			
		}
		
		if (isset($data['expires']))
		{
			
			$this->setExpires($data['expires']);
			
		}
		
		if (isset($data['finished']))
		{
			
			$this->setFinished($data['finished']);
			
		}
		
		if (isset($data['started']))
		{
			
			$this->setStarted($data['started']);
			
		}
		
		$this->setName($data['name']);
		
	}
	
	public function activate($active=null,$expires=null)
	{
		
		$data = array('id'=>$this->getId());
		
		if ($active === null)
		{
		
			$active = REQUEST_TIME;
		
		}
		
		$data['active'] = $active;
		
		$data['expires'] = $expires;
			
		$this->getManager()->activate($data);
		
		$this->setActive($data['active']);
		
		$this->setExpires($data['expires']);
		
		return $this;
	
	}
	
	public function expire($expires=null)
	{
	
		$data = array('id'=>$this->getId());
		
		if (null === $expires)
		{
		
			$expires = REQUEST_TIME;
		
		}
		
		$data['expires'] = $expires;
		
		$this->getManager()->expire($data);
		
		$this->setExpires($data['expires']);
		
		return $this;
	
	}
	
	public function finish($finished=null)
	{
	
		$data = array('id'=>$this->getId());
		
		if (null === $finished)
		{
		
			$finished = REQUEST_TIME;
		
		}
		
		$data['finished'] = $finished;
		
		$this->getManager()->finish($data);
		
		return $this;
	
	}
	
	public function getActive()
	{
	
		return $this->_active;
		
	}
	
	public function getContext()
	{
	
		return $this->_context;
		
	}
	
	public function getExpires()
	{
	
		return $this->_expires;
	
	}
	
	public function getFinished()
	{
	
		return $this->_finished;
	
	}
	
	public function getId()
	{
	
		return $this->_id;
		
	}
	
	public function getManager()
	{
	
		return $this->_manager;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function getStarted()
	{
	
		return $this->_started;
	
	}
	
	public function isActive()
	{
	
		if (!$this->getActive())
		{
		
			return true;
		
		}
		
		if ($this->getActive() <= REQUEST_TIME)
		{
		
			return true;
		
		}
		
		return false;
		
	}
	
	public function isExpired()
	{
	
		if (!$this->getExpires())
		{
		
			return false;
			
		}
		
		if ($this->getExpires() > REQUEST_TIME)
		{
		
			return false;
		
		}
		
		return true;
	
	}
	
	public function isFinished()
	{
	
		if ($this->getFinished())
		{
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function isStarted()
	{
	
		if ($this->getStarted())
		{
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function setActive($active)
	{
	
		$this->_active = floatval($active);
		
		return $this;
	
	}
	
	public function setContext($context)
	{
	
		$this->_context = $context;
		
		return $this;
	
	}
	
	public function setExpires($expires)
	{
	
		$this->_expires = floatval($expires);
		
		return $this;
	
	}
	
	public function setFinished($finished)
	{
	
		$this->_finished = floatval($finished);
		
		return $this;
	
	}
	
	public function setManager(Inclusive_Event_Manager $manager)
	{
	
		$this->_manager = $manager;
		
		return $this;
	
	}
	
	public function setStarted($started)
	{
	
		$this->_started = floatval($started);
		
		return $this;
	
	}
	
	public function stert($started=null)
	{
	
		$data = array('id'=>$this->getId());
		
		if (null === $started)
		{
		
			$started = REQUEST_TIME;
			
		}
		
		$data['started'] = $started;
		
		$this->getManager()->start($data);
		
		$this->setStarted($data['started']);
		
		return $this;
	
	}
	
	public function trigger()
	{
	
		$this->getManager()->trigger($this);
		
		return $this;
	
	}
	
}