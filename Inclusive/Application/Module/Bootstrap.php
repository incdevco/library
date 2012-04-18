<?php

class Inclusive_Application_Module_Bootstrap 
	extends Zend_Application_Module_Bootstrap {

	public function _initSets() {
	
		$this->getResourceLoader()
			->addResourceType('Set','sets','Set');
	
	}

}