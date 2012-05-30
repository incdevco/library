<?php

class Inclusive_Service_Adapter_Lucene
	extends Inclusive_Service_Adapter_Abstract
{

	protected $_lucene = null;

	protected $_luceneClass = null;
	
	public function getLucene()
	{
	
		if (!($this->_lucene instanceof Inclusive_Search_Lucene))
		{
		
			$class = $this->getLuceneClass();
			
			$this->setLucene(new $class());
		
		}
		
		return $this->_lucene;
	
	}
	
	public function getLuceneClass()
	{
	
		if ($this->_luceneClass === null)
		{
		
			return $this->_throw('No Lucene Class Set');
			
		}
		
		return $this->_lucene;
	
	}
	
	public function setLucene(Inclusive_Search_Lucene $lucene)
	{
	
		$this->_lucene = $lucene;
		
		return $this;
	
	}
	
	public function setLuceneClass($class)
	{
	
		$this->_luceneClass = $class;
		
		return $this;
	
	}
	
}