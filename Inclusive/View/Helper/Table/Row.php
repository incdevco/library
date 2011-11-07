<?php

class Inclusive_View_Helper_Table_Row extends Zend_View_Helper_Abstract {
	
	public function row($row,$options=null) {
		
		$string = '';
		
		if (is_array($row)) {
			
			$string .= '<tr class="'.((isset($options['class'])) ? $options['class'] : '').'">';
			
			foreach ($row as $key => $value) {
				
				$string .= '<td class"'.$key.'">'.$value.'</td>';
				
			}
			
			$string .= '</tr>';
			
		} elseif ($row instanceof Inclusive_Table_Row) {
			
			$string .= '<tr class="'.(($row->getOption('class')) ? $row->getOption('class') : '').'">';
			
			foreach ($row->getFields() as $field) {
				
				$string .= '<td class="'.strtolower($field).'">';
				
				$value = $row->getValue($field);
				
				if ($value instanceof Zend_Navigation) {
					
					$string .= $this->view->navigation()->menu($value)->render();
					
				} else {
					
					$string .= $value;
					
				}
				
				$string .= '</td>';
				
			}
			
			$string .= '</tr>';
			
		} else {
			
			$string .= $row;
			
		}
		
		return $string;
		
	}
	
}