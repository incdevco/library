<?php

class Inclusive_Pdf_Page extends Zend_Pdf_Page
{
	
	public function __construct($param1=null)
	{
		
		if (null === $param1)
		{
		
			$param1 = Zend_Pdf_Page::SIZE_LETTER;
		
		}
		
		parent::__construct($param1);
	
	}
	
	public function drawText($text, $x, $y, $charEncoding = 'UTF-8')
	{
	
		return parent::drawText($text,$x,$y,$charEncoding);
	
	}

}