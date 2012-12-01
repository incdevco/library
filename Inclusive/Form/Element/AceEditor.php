<?php

class Inclusive_Form_Element_AceEditor extends Inclusive_Form_Element_TextEditor 
{
	
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
		
		//if ($this->isUserAgentSupported()) {
			
			$this->getDecorator('HtmlTag')
			    ->setTag('div')
			    ->setOption('class','AceEditor');
			
	        $this->getView()->headScript()
	            ->appendFile('http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js')
	            ->appendScript('var editor = ace.edit("'.$this->getId().'"); editor.setTheme("ace/theme/monokai"); editor.getSession().setMode("ace/mode/javascript");');
	        
	   //}
		
		$content = '<div id="'.$this->getId().'">'.$this->getValue().'</div><input type="hidden" name="'.$this->getName().'" value="'.$this->getValue().'" />';
		
		return $content;
		
	}
	
}