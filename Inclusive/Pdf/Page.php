<?php

class Inclusive_Pdf_Page extends Zend_Pdf_Page
{

	public function drawText($text, $x, $y, $charEncoding = 'UTF-8')
	{
	
		return parent::drawText($text,$x,$y,$charEncoding);
	
	}

}