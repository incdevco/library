<?php

class Inclusive_View_Helper_Prototype extends Zend_View_Helper_Abstract {
	
	protected $_defaultClass = 'prototype';
	
	public function prototype($object=null,$options=array()) {
		
		if ($object === null) {
			
			return $this;
			
		}
		
		if ($object instanceof Zend_Db_Table_Row_Abstract) {
			
			return $this->renderRow($object,$options);
			
		} elseif ($object instanceof Zend_Db_Table_Rowset_Abstract) {
			
			return $this->renderSet($object,$options);
			
		} elseif (is_array($object)) {
			
			return $this->renderArray($object,$options);
			
		}
		
	}
	
	protected function _setClassOption(array $options,$object=null) {
		
        if (!isset($options['class'])
            or empty($options['class'])) {
            
            if ($object !== null
                && isset($object->prototypeClass)
                && !empty($object->prototypeClass)) {
                
                $options['class'] = $object->prototypeClass;
                
            } else {
                
                $options['class'] = $this->_defaultClass;
                
            }
            
        }
        
        return $options;
        
	}
	
	public function renderRow(Zend_Db_Table_Row_Abstract $object,$options=array()) {
		
		$options = $this->_setClassOption($options,$object);
		
		$string = '<div class="container">';
		
		if (isset($options['title']) && !empty($options['title'])) {
			
		    $string .= '<h3 class="title">'.$options['title'].'</h3>';
		
        }
        
        $string .= '<dl class="'.$options['class'].'">';
        
        foreach ($object->toArray() as $key => $value) {
        	
        	$string .= '<dt class="'.$key.'">'.$key.'</dt><dd class="'.$key.'">'; 
        	
        	if ($value) {
        
                if (is_object($value) or is_array($value)) {
                            
                    $string .= $this->prototype($value);
                            
                } else {
                            
                    $string .= $this->view->escape($value);
                            
                }
                        
        	} else {
        		
        		$string .= '&nbsp;';
        		
        	}
        	
        	$string .= '</dd>';
        	
        }
        
        $string .= '</dl>';
        
		$string .= '</div>';
		
		return $string;
		
	}
	
	public function renderSet(Zend_Db_Table_Rowset_Abstract $object,$options=array()) {
		
        $options = $this->_setClassOption($options,$object);
        
        $string = '<table class="'.$options['class'].'">';
        
        if (isset($options['caption']) && !empty($options['caption'])) {
        	
        	$string .= '<caption>'.$options['caption'].'</caption>';
        	
        }
        
        $columnCount = 0;
        
        $string .= '<thead><tr>';
        
        $navigation = false;
        
        if ($object->count()) {
        	
        	$row = $object->rewind()->current();
        	
        	foreach ($row->toArray() as $key => $value) {
        		
        		$string .= '<th class="'.$key.'">'.$key.'</th>';
        		
        		$columnCount++;
        		
        	}
	        	
	        if (method_exists($row,'getNavigation')) {
	            
	            $navigation = true;
	            
	        }
	        
        	if ($navigation) {
        		
        		$string .= '<th class="navigation">Navigation</th>';
        		
        		$columnCount++;
        		
        	}
        	
        } else {
        	
        	$string .= '<th>None</th>';
        	
        	$columnCount++;
        	
        }
        
        $string .= '</tr></thead>';
        
        $string .= '<tbody>';
        
        if ($object->count()) {
        	
        	foreach ($object as $row) {
        		
        		$string .= '<tr>';
        		
        		foreach ($row->toArray() as $key => $value) {
        			
        			$string .= '<td class="'.$key.'">';
        				
		            if ($value) {
		                
		                if (is_object($value) or is_array($value)) {
		                    
		                    $string .= $this->prototype($value);
		                    
		                } else {
		                	
		                	$string .= $this->view->escape($value);
		                	
		                }
		                
		            } else {
		                
		                $string .= '&nbsp;';
		                
		            }
		            
        			$string .= '</td>';
        			
        		}
        		
        		if ($navigation) {
        			
        			$string .= '<td class="navigation">'.$this->view->navigation()->menu($row->getNavigation()).'</td>';
        			
        		}
        		
        		$string .= '</tr>';
        		
        	}
        	
        } else {
        	
        	$string .= '<tr><td colspan="'.$columnCount.'">None</td>';
        	
        }
        
        $string .= '</tbody>';
        
        $string .= '</table>';
        
        return $string;
        
	}
	
	public function renderArray(array $object,$options=array()) {
		
        $options = $this->_setClassOption($options,$object);
        
        $string = '<div class="container">';
        
        if (isset($options['title']) && !empty($options['title'])) {
            
            $string .= '<h3 class="title">'.$options['title'].'</h3>';
        
        }
        
        $string .= '<dl class="'.$options['class'].'">';
        
        foreach ($object as $key => $value) {
            
            $string .= '<dt class="'.$key.'">'.$key.'</dt><dd class="'.$key.'">'.(($value) ? $this->view->escape($value) : '&nbsp;').'</dd>';
            
        }
        
        $string .= '</dl>';
        
        $string .= '</div>';
        
        return $string;
        
	}
	
}