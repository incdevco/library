<?php

class Inclusive_View_Helper_Div extends Zend_View_Helper_Abstract 
{
	
	public function div($content,$options=null) 
	{
		
		$string = '<div'.$this->renderAttribs($options).'>';
		
		$string .= $content;
		
		$string .= '</div>';
		
		return $string;
		
	}
	
	public function renderAttribs($options=null)
	{
	
		$string = '';
		
		if (isset($options['class']) && !empty($options['class']))
		{
		
			$string .= ' class="'.strval($options['class']).'"';
		
		}
		
		if (isset($options['id']) && !empty($options['id']))
		{
		
			$string .= ' id="'.strval($options['id']).'"';
		
		}
		
		return $string;
	
	}
	
}