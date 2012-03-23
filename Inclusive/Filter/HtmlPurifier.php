<?php

require_once "HTMLPurifier.auto.php";

class Inclusive_Filter_HtmlPurifier implements Zend_Filter_Interface {
	
	protected $_config;
	
	protected $_purifier;
	
	public function __construct($config=null) {
	
		if ($config) {
		
			$this->setConfig($config);
		
		}
	
	}
	
	public function filter($value) {
		
		$value = $this->getPurifier()->purify($value);
		
		return $value;
		
	}
	
	public function getDefaultConfig() {
		
		$config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Doctype', 'XHTML 1.1');
        $config->set('HTML.DefinitionID', 'inclusivedv-default');
        $config->set('HTML.DefinitionRev', '1');
        $config->set('Cache.DefinitionImpl', null);
        $config->set('Attr.EnableId',true);
        $config->set('Attr.IDPrefix','user_');
        $config->set('Filter.YouTube',true);
        $def = $config->getHTMLDefinition(true);
        $def->addAttribute('a', 'target', 'Enum#_blank,_self,_target,_top');
                
        return $config;
        
	}
	
	public function setConfig(HTMLPurifier_Config $config) {
		
		$this->_config = $config;
		
		return $this;
		
	}
	
	public function getConfig() {
		
		if (!($this->_config instanceof HTMLPurifier_Config)) {
			
			$this->setConfig($this->getDefaultConfig());
			
		}
		
		return $this->_config;
		
	}
	
	public function getPurifier() {
		
		if (!($this->_purifier instanceof HTMLPurifier)) {
			
			$config = $this->getConfig();
			
			$this->_purifier = new HTMLPurifier($config);
			
		}
		
		return $this->_purifier;
		
	}
	
}