<?php

class Inclusive_View_Helper_Container extends Zend_View_Helper_Abstract {
	
	public function container($content,$options=null) {
		
		$string = '';
		
		if (isset($options['title'])) {
			
			$string .= '<h3 class="title">'.$options['title'].'</h3>';
			
		}
		
		$string .= $content;
		
        if (isset($options['wrapper'])
            && $options['wrapper']) {
            
            $string = '<div class="wrapper">'.$string.'</div>';
            
        }
        
		$string = '<div class="container '.(isset($options['class']) ? $options['class'] : '').'">'.$string.'</div>';
		
		return $string;
		
	}
	
}