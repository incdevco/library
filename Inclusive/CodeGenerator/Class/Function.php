<?php

class Inclusive_CodeGenerator_Class_Function extends Inclusive_CodeGenerator_Function
{
	
	protected $_abstract = false;
	
	public function generate()
	{
	
		$string = $this->generateHead();
		
		if ($this->getAbstract())
		{
		
			$string = 'abstract '.$string;
			
		}
		
		$string = "\t".$string;
		
		$string .= $this->generateBody();
		
		return $string;
	
	}
	
	public function getAbstract()
	{
	
		return $this->_abstract;
	
	}
		
	public function setAbstract($abstract)
	{
	
		$this->_abstract = ($abstract) ? true : false;
		
		return $this;
	
	}
	
}