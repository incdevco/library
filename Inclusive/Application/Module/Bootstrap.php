<?php

class Inclusive_Application_Module_Bootstrap extends Zend_Application_Module_Bootstrap 
{

	public function _initSets() 
	{
	
		$this->getResourceLoader()
			->addResourceType('Assert','assertions','Assert')
			->addResourceType('Element','elements','Element')
			->addResourceType('Filter','filters','Filter')
			->addResourceType('Set','sets','Set')
			->addResourceType('Transformer','transformers','Transformer')
			->addResourceType('Validate','validators','Validate');
	
	}

}
