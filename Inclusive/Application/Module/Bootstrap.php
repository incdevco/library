<?php

class Inclusive_Application_Module_Bootstrap 
	extends Zend_Application_Module_Bootstrap {

	public function _initSets() {
	
		$this->getResourceLoader()
			->addResourceType('Filter','filters','Filter')
			->addResourceType('Set','sets','Set')
			->addResourceType('Validate','validators','Validate')
			->addResourceType('Assert','assertions','Assert');
	
	}

}