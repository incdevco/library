<?php

class Inclusive_Search_Lucene extends Zend_Search_Lucene_Proxy
{

	protected $_directory = null;

	public function __construct(
		Zend_Search_Lucene_Interface $index=null
	)
	{
	
		if ($index === null)
		{
		
			$directory = $this->getDirectory();
		
			if ($directory === null)
			{
			
				throw new Inclusive_Search_Exception(
					'You must provide an index or set the $_directory variable.'
					);
			
			}
			
			try 
			{
			
				$index = new Zend_Search_Lucene($directory, false);
				
			}
			catch (Zend_Search_Lucene_Exception $e)
			{
			
				$index = new Zend_Search_Lucene($directory,true);
			
			}
		
		}
		
		parent::__construct($index);
	
	}
	
	public function deleteIndex()
	{
	
		$directory = $this->getDirectory();
		
		system("rm -rf $directory/*");
		
	}
		
	public function getDirectory()
	{
	
		return $this->_directory;
	
	}

}