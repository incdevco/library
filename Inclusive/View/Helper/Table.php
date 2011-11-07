<?php

class Inclusive_View_Helper_Table extends Zend_View_Helper_Abstract {
	
	public function table(array $rows,array $options=null) {
		
		if (!count($rows)) {
			
			return 'No Rows';
			
		}
		
		$string = '<table class="'.((isset($options['class'])) ? 
		    $options['class'] : '').'">';
		
		if (isset($options['caption'])) {
			
			$string .= $this->renderCaption($options['caption']);
			
		}
		
		$string .= "<thead>\n";
		
		$string .= $this->renderHeader($rows[0],$options);
		
		$string .= "</thead>\n";
		
		$string .= "<tbody>\n";
		
		foreach ($rows as $row) {
			
			$string .= $this->renderRow($row,$options);
			
		}
		
		$string .= "</tbody>\n";
		
		return $string .= "</table>\n";
		
	}
	
	public function renderCaption($caption) {
		
		return '<caption>'.$caption."</caption>\n";
		
	}
	
	public function renderHeader($row,array $options=null) {
		
		$string = '';
		
		if (is_array($row)) {
			
			$string .= '<tr>';
			
			foreach ($row as $key => $value) {
				
				$string .= '<th class="'.strtolower($key).'"><span>'.$key.'</span></th>';
				
			}
			
			$string .= "</tr>\n";
			
		} elseif ($row instanceof Inclusive_Table_Row) {
			
			$string .= '<tr>';
			
			foreach ($row->getFields() as $field) {
				
				$string .= '<th class="'.strtolower($field).'">'.$field.'</th>';
				
			}
			
			$string .= '</tr>';
			
		} else {
			
			$string .=  $row;
			
		}
		
		return $string;
		
	}
	
	public function renderRow($row,array $options=null) {
		
		$string = '';
		
		if (is_array($row)) {
		
			$string .= '<tr>';
			
			foreach ($row as $key => $value) {
				
				$string .= '<td class="'.strtolower($key).'">'.$value.'</td>';
				
			}
			
			$string .= "</tr>\n";
		
		} elseif ($row instanceof Inclusive_Table_Row) {
			
			$this->view->addHelperPath('Inclusive/View/Helper/Table','Inclusive_View_Helper_Table');
			
			$string .= $this->view->row($row);
			
		} else {
			
			$string .= $row;
			
		}
		
		return $string;
		
	}
	
}