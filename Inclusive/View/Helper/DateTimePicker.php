<?php

class Inclusive_View_Helper_DateTimePicker extends Zend_View_Helper_FormText {
	
	public function dateTimePicker($name,$value=null,$attribs=null) {
		
		$xhtml = parent::formText($name,$value,$attribs);
		
		$this->view->headLink()->appendStylesheet('/css/anytime.css');
		
		$this->view->jquery()->addJavascriptFile('/js/anytime.js');
		
		$this->view->jquery()->addOnload('AnyTime.picker("'.$name.'",{format:"%c/%e/%Y %h:%i:%s %p"});');
		
		return $xhtml;
		
	}
	
}