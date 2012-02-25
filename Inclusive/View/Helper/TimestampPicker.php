<?php

class Inclusive_View_Helper_TimestampPicker extends Zend_View_Helper_FormText {
	
	public function timestampPicker($name,$value=null,$attribs=null) {
		
		$xhtml = parent::formText($name,$value,$attribs);
		
		return $xhtml;
		
	}
	
}