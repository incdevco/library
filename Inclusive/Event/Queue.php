<?php

class Inclusive_Event_Queue 
{

	protected $_adapter = null;
	
	protected $_adapterClass = 'Inclusive_Event_Queue_Adapter_File';
	
	public function getAdapter()
	{
	
		if (null === $this->_adapter)
		{
		
			$class = $this->_adapterClass;
		
		}
		
		return $this->_adapter;
	
	}

}