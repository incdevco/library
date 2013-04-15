<?php

class Inclusive_View_Helper_DefinitionList extends Zend_View_Helper_Abstract {
	
	public function definitionList(array $row,array $options=null) {
		
		$string = '<dl'.((isset($options['class'])) ? ' class="'.$options['class'].'"' : ' class="inclusive"').'>';
		
		foreach ($row as $key => $value) {
			
			$class = strtolower($key);
			
			$string .= $this->renderTerm($key,$class);
			
			$string .= $this->renderDefinition($value,$class);
			
		}
		
		return $string .= "</dl>\n";
		
	}
	
	public function renderTerm($term,$class=null) {
		
		return '<dt class="'.(($class) ? $class : '').'">'.((empty($term)) ? '&nbsp;' : $term).'</dt>';
		
	}
	
	public function renderDefinition($definition,$class=null) {
		
        return '<dd class="'.(($class) ? $class : '').'">'.((empty($definition)) ? '&nbsp;' : $definition).'</dd>';
        
	}
	
}