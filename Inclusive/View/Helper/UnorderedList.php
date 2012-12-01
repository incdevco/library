<?php

class Inclusive_View_Helper_UnorderedList
	extends Zend_View_Helper_Abstract
{

	public function unorderedList(Inclusive_View_List $list)
	{
	
		$string = '<ul class="'.$list->getClass().'">';
		
		foreach ($list->getItems() as $item)
		{
		
			$string .= '<li>'.$item->getContent().'</li>';
		
		}
		
		$string .= '</ul>';
		
		return $string;
	
	}

}