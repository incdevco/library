<?php

class Inclusive_Model_Transformer_Keys extends Inclusive_Model_Transformer_Abstract
{
	
	protected $_keys = null;
	
	protected $_noMatch = array();
	
	protected $_required = null;
	
	public function __construct(array $options=array())
	{
	
		if (isset($options['keys']) && !empty($options['keys']))
		{
		
			$this->_keys = $options['keys'];
		
		}
		
		if (isset($options['required']))
		{
		
			$this->_required = $options['required'];
		
		}
	
	}
	
	public function commit(Inclusive_Model_Abstract $model)
	{
	
		$model->save();
		
		return true;
	
	}
	
	public function match(Inclusive_Model_Abstract $model,$data)
	{
	
		$match = false;
		
		foreach ($this->_keys as $key)
		{
		
			if (isset($data[$key]))
			{
			
				$match = true;
			
			}
		
		}
		
		foreach ($this->_noMatch as $key)
		{
			
			if (isset($data[$key]))
			{
			
				$match = false;
			
			}
		
		}
		
		return $match;
	
	}
	
	public function rollback(Inclusive_Model_Abstract $model)
	{
	
		$model->reset();
		
		return true;
	
	}
	
	public function transform(Inclusive_Model_Abstract $model,$data)
	{
	
		$clean = $this->isValid($data);
		
		foreach ($this->_keys as $key)
		{
		
			if (isset($clean[$key]))
			{
			
				$model->set($key,$clean[$key]);
			
			}
		
		}
	
	}

}