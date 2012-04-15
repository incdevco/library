<?php

class Inclusive_Service_Ebay_Request_GetCategories
	extends Inclusive_Service_Ebay_Request_Abstract {
	
	public $callName = 'GetCategories';
	
	protected $_CategorySiteID = 0;
	
	protected $_DetailLevel = 'ReturnAll';
	
	protected $_LevelLimit = 1;
	
	protected $_ViewAllNodes = true;
	
	public function toXml() {
	
		$string = $this->_renderXml();
		
		$string .= '<GetCategoriesRequest xmlns="urn:ebay:apis:eBLBaseComponents">';
		
		$string .= $this->_renderWarningLevel();
		
		$string .= $this->_rendereBayAuthToken();
		
		$string .= $this->_renderCategorySiteID();
		
		$string .= $this->_renderLevelLimit();
		
		$string .= $this->_renderDetailLevel();
		
		if ($this->_ViewAllNodes) {
		
			$string .= $this->_renderViewAllNodes();
		
		}
		
		$string .= $this->_renderWarningLevel();
		
		$string .= '</GetCategoriesRequest>';
		
		return $string;
	
	}
	
	public function getResponse($response) {
	
		return 
			new Inclusive_Service_Ebay_Response_GetCategories($response);
	
	}
	
	// render functions
	
	protected function _renderCategorySiteID() {
	
		return $this->_renderValue('CategorySiteID');
	
	}
	
	protected function _renderDetailLevel() {
	
		return $this->_renderValue('DetailLevel');
	
	}
	
	protected function _renderLevelLimit() {
	
		return $this->_renderValue('LevelLimit');
	
	}
	
	protected function _renderViewAllNodes() {
	
		return $this->_renderValue('ViewAllNodes');
	
	}
		
}