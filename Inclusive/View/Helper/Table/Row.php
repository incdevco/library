<?php

class Inclusive_View_Helper_Table_Row extends Zend_View_Helper_Abstract {
	
	public function row($row,array $options=null) {
		
		$string = '';
		
		if (is_array($row)) {
			
			$string .= '<tr class="'.((isset($options['class'])) ? $options['class'] : '').'">';
			
			foreach ($row as $key => $value) {
				
				$string .= '<td class"'.$key.'">'.$value.'</td>';
				
			}
			
			$string .= '</tr>';
			
		} 
		elseif ($row instanceof Inclusive_View_Table_Row) 
		{
			
			$string .= '<tr class="'.(($row->getOption('class')) ? $row->getOption('class') : '').'">';
			
			foreach ($row->getColumns() as $column) {
				
				$string .= '<td class="'.$column->getOption('class').'"';
				
				if (isset($options['colspan']))
				{
				
					$string .= ' colspan="';
					
					$string .= $options['colspan'];
					
					$string .= '" ';
				
				}
				
				$string .= '>';
				
				$string .= $column->getValue();
				
				$string .= '</td>';
				
			}
			
			if ($row->getOption('navigation'))
			{
			
				$string .= '<td class="navigation">'
					.$this->view->navigation()->menu($row->getOption('navigation'))->render()
					.'</td>';
			
			}
			
			$string .= '</tr>';
			
		}
		elseif ($row instanceof Inclusive_View_Table) 
		{
			
			$string .= '<tr>';
			
			$string .= '<td colspan="'.$this->view->table()->getColumnCount().'">';
				
			$string .= $this->view->table($row);
				
			$string .= '</td>';
			
			$string .= '</tr>';
			
		} 
		else {
			
			$string .= $row;
			
		}
		
		return $string;
		
	}
	
}