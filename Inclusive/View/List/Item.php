<?php

class Inclusive_View_List_Item
{

	protected $_content = null;
	
	protected $_options = null;

	public function __construct($content,$options=null)
	{
	
		$this->_content = $content;
		
		$this->_options = $options;
		
	}
	
	public function getContent()
	{
	
		return $this->_content;
		
	}

}