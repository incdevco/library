<?php

class Inclusive_StaticSite_Page
{
	
	protected $_data = array();
	
	protected $_generator = null;

	protected $_scriptBase = null;
	
	protected $_script = null;
		
	public function __construct(Inclusive_StaticSite_Generator $generator,$options=null)
	{
	
		$this->_generator = $generator;
		
		if ($options != null)
		{
		
			$this->setOptions($options);
		
		}
	
	}

}