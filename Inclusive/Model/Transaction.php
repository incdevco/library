<?php

class Inclusive_Model_Transaction 
{
	
	protected $_committed = null;
	
	protected $_rolledback = null;
	
	protected $_started = null;
	
	protected $_transformers = array();
	
	public function addTransformer(Inclusive_Model_Transformer_Abstract $transformer)
	{
	
		$this->_transformers[] = $transformer;
		
		return $this;
	
	}
	
	public function commit(Inclusive_Model_Abstract $model)
	{
		
		if ($this->isCommitted())
		{
		
			throw new Inclusive_Model_Transaction_Exception_AlreadyCommitted($this);
		
		}
		
		if ($this->isRolledback())
		{
		
			throw new Inclusive_Model_Transaction_Exception_AlreadyRolledback($this);
		
		}
		
		foreach ($this->getTransformers() as $transformer)
		{
		
			$transformer->commit($model);
		
		}
		
		$this->_committed = microtime(true);
		
		return $this;
	
	}
	
	public function getTransformers()
	{
	
		return $this->_transformers;
	
	}
	
	public function isCommitted()
	{
	
		if ($this->_committed)
		{
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function isRolledback()
	{
	
		if ($this->_rolledback)
		{
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function rollback(Inclusive_Model_Abstract $model)
	{
		
		if ($this->isCommitted())
		{
		
			throw new Inclusive_Model_Transaction_Exception_AlreadyCommitted($this);
		
		}
		
		foreach ($this->getTransformers() as $transformer)
		{
		
			$transformer->rollback($model);
		
		}
		
		$this->_rolledback = microtime(true);
		
		return $this;
	
	}
	
	public function start()
	{
	
		$this->_started = microtime(true);
		
		return $this;
	
	}

}