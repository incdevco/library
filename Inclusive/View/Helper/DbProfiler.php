<?php

class Inclusive_View_Helper_DbProfiler extends Zend_View_Helper_Abstract
{

	public function dbProfiler()
	{
	
		$adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
		
		$profiles = $adapter->getProfiler()->getQueryProfiles();
		
		$table = new Inclusive_View_Table();
		
		foreach ($profiles as $profile)
		{
			
			$table->addRow(array(
				'Query'=>$profile->getQuery(),
				'Elasped Time'=>$profile->getElapsedSecs()
				));
		
		}
		
		return $this->view->table($table);
	
	}

}