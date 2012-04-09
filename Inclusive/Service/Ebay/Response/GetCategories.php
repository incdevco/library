<?php

class Inclusive_Service_Ebay_Response_GetCategories
	extends Inclusive_Service_Ebay_Response_Abstract {
	
	public function getCategoriesAsMultiOptions() {
	
		$xml = new Zend_Config_Xml($this->getResponse());
		
		$multiOptions = array();
		
		foreach ($xml->CategoryArray->Category as $category) {
		
			$multiOptions[$category->CategoryID] = 
				$category->CategoryName;
		
		}
		
		return $multiOptions;
		
	}
	
}