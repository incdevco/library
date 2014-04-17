<?php

class Inclusive_Filter_RemoveCommas extends Zend_Filter_Word_SeparatorToSeparator
{

	public function __construct($searchSeparator=',',$replacementSeparator='')
	{
	
		parent::__construct($searchSeparator,$replacementSeparator);
		
	}

}