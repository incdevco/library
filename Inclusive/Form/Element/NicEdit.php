<?php

class Inclusive_Form_Element_NicEdit extends Zend_Form_Element_Textarea {
	
	public function __construct($spec,$options=null) {
		
		parent::__construct($spec,$options);
		
		$this->addHtmlPurifierFilter();
		
	}
	
	public function addHtmlPurifierFilter() {
		
		if ($this->getFilter('Inclusive_Filter_HtmlPurifier')) {
		
		    $this->addFilter(new Inclusive_Filter_HtmlPurifier());
		
		}
		
	}
	
	public function isUserAgentSupported() {
		
		if (!isset($_SERVER['HTTP_USER_AGENT'])) {
			
			return false;
			
		}
		
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		
		if (!preg_match('/iP(hone|od|ad)/',$userAgent)) {
			
			return true;
			
		}
		
		return false;
		
	}
	
	public function render(Zend_View_Interface $view = null) {
		
		if ($this->isUserAgentSupported()) {
			
			$this->getDecorator('HtmlTag')
			    ->setTag('div')
			    ->setOption('class','nicEdit');
			
	        $this->getView()->headScript()
	            ->appendFile('http://js.nicedit.com/nicEdit-latest.js')
	            ->appendScript("bkLib.onDomLoaded(function() { new nicEditor({
	                fullPanel : true
	                }).panelInstance('".$this->getId()."');});");
	        
	   }
		
		$content = parent::render($view);
		
		return $content;
		
	}
	
}