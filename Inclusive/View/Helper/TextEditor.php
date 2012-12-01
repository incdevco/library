<?php

class Inclusive_View_Helper_TextEditor
	extends Zend_View_Helper_FormTextarea
{

	protected $_renderJavascript = true;
	
	protected $_format = '%c/%e/%Y %h:%i:%s %p';

	public function textEditor($name,$value=null,$attribs=null) {
		
		if (!isset($attribs['class']))
		{
		
			$attribs['class'] = 'text_editor';
		
		}
		else 
		{
		
			$attribs['class'] .= ' text_editor';
		
		}
		
		$xhtml = parent::formTextarea($name,$value,$attribs);
		
		$this->_renderJavascript();
		
		return $xhtml;
		
	}
	
	protected function _renderJavascript()
	{
	
		if ($this->_renderJavascript)
		{
		
			$this->view->JQuery()->addOnload('$("textarea.text_editor").live("keydown",function(e){ var keyCode = e.keyCode || e.which; if (keyCode == 9){ var myValue = "\t"; var startPos = this.selectionStart; var endPos = this.selectionEnd; var scrollTop = this.scrollTop; this.value = this.value.substring(0, startPos) + myValue + this.value.substring(endPos,this.value.length); this.focus(); this.selectionStart = startPos + myValue.length; this.selectionEnd = startPos + myValue.length; this.scrollTop = scrollTop; e.preventDefault(); } });');
			
			$this->_renderJavascript = false;
			
		}
	
	}
	
}