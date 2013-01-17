<?php

class Inclusive_PHPUnit_TableAdapterTestCase extends PHPUnit_Framework_TestCase 
{

	protected $_dbAdapter = null;

	public function setUp() 
	{
		
		parent::setUp();
		
		Zend_Db_Table_Abstract::setDefaultAdapter($this->getDbAdapter());
		
	}
	
	public function getDbAdapter()
	{
	
		if ($this->_dbAdapter === null)
		{
		
			$this->_dbAdapter = new Zend_Test_DbAdapter();
		
		}
		
		return $this->_dbAdapter;
	
	}
 	
}