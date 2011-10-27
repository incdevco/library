<?php

class Inclusive_View_Helper_Table extends Zend_View_Helper_Abstract {
	
	public function table(array $rows,array $options=null) {
		
		if (!count($rows)) {
			
			return 'No Rows';
			
		}
		
		$string = '<table '.((isset($options['class'])) ? $options['class'] : '').'>';
		
		if (isset($options['caption'])) {
			
			$string .= $this->renderCaption($options['caption']);
			
		}
		
		$string .= "<thead>\n";
		
		$string .= $this->renderHeader($rows[0]);
		
		$string .= "</thead>\n";
		
		$string .= "<tbody>\n";
		
		foreach ($rows as $row) {
			
			$string .= $this->renderRow($row);
			
		}
		
		$string .= "</tbody>\n";
		
		return $string .= "</table>\n";
		
	}
	
	public function renderCaption($caption) {
		
		return '<caption>'.$caption."</caption>\n";
		
	}
	
	public function renderHeader(array $row,array $options=null) {
		
		$string = '<tr>';
		
		foreach ($row as $key => $value) {
			
			$string .= '<th class="'.strtolower($key).'">'.$key.'</th>';
			
		}
		
		return $string .= "</tr>\n";
		
	}
	
	public function renderRow(array $row,array $options=null) {
		
		$string = '<tr>';
		
		foreach ($row as $key => $value) {
			
			$string .= '<td class="'.strtolower($key).'">'.$value.'</td>';
			
		}
		
		return $string .= "</tr>\n";
		
	}
	
}