<?php

class Inclusive_View_Helper_Table_Row extends Zend_View_Helper_Abstract {
	
	public function row(array $row,$options=null) {
		
		$string = '<tr class="'.((isset($options['class'])) ? $options['class'] : '').'">';
		
		foreach ($row as $key => $value) {
			
			$string .= '<td class"'.$key.'">'.$value.'</td>';
			
		}
		
		$string .= '</tr>';
		
		return $string;
		
	}
	
}