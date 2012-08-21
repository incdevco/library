<?php

class Inclusive_View_Helper_Table extends Zend_View_Helper_Abstract {
	
	public function table($table,array $options=null) {
		
		if ($table instanceof Inclusive_Table
			or $table instanceof Inclusive_View_Table) {
		
			if (!$table->count()) {
			
				return 'No Rows';
			
			}
		
		} elseif (is_array($table)) {
			
			if (!count($table)) {
				
				return 'No Rows';
				
			}
					
		} else {
		
			return '';
		
		}
		
		$string = '<table class="'.((isset($options['class'])) ? 
		    $options['class'] : '').'">';
		
		if (isset($options['caption'])) {
			
			$string .= $this->renderCaption($options['caption']);
			
		}
		
		$string .= "<thead>\n";
		
		if ($table instanceof Inclusive_Table
			or $table instanceof Inclusive_View_Table) {
		
			$header = $table->getFirstRow();
		
		} elseif (is_array($table)) {
			
			$header = $table[0];
					
		}
		
		$string .= $this->renderHeader($header,$options);
		
		$string .= "</thead>\n";
		
		$string .= "<tbody>\n";
		
		if ($table instanceof Inclusive_Table
			or $table instanceof Inclusive_View_Table) {
		
			$rows = $table->getRows();
		
		} elseif (is_array($table)) {
			
			$rows = $table;
					
		}
		
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
			
		} elseif ($row instanceof Inclusive_Table_Row
			or $row instanceof Inclusive_View_Table_Row) 
		{
			
			$string .= '<tr>';
			
			foreach ($row->getColumns() as $column) {
				
				$string .= '<th class="'.strtolower($column->getOption('class')).'">'.$column->getKey().'</th>';
				
			}
			
			if ($row->getOption('navigation'))
			{
			
				$string .= '<th class="navigation">&nbsp;</th>';
			
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
		
		} elseif ($row instanceof Inclusive_Table_Row
			or $row instanceof Inclusive_View_Table_Row) {
			
			$this->view->addHelperPath('Inclusive/View/Helper/Table','Inclusive_View_Helper_Table');
			
			$string .= $this->view->row($row);
			
		} else {
			
			$string .= $row;
			
		}
		
		return $string;
		
	}
	
}