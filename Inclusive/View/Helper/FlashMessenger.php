<?php

class Inclusive_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract {
	
	protected $_javascriptAdded = false;
	
	protected $_autoHide = false;
	
	protected $_autoHideMilliseconds = 2500;
	
	/*
	 * Render messages from flashMessender
	 * Set $currentMessages to true to display current messages.
	 * Set $autoHide to true, to add javascript to fade out flashMessenger container.
	 * Set $autoHide to an integer of milliseconds to auto hide after, will also enable auto hide.
	 */
	public function flashMessenger($autoHide=true) 
	{
		
		if ($autoHide)
		{
		
			$this->_autoHide = true;
			
			if (is_int($autoHide))
			{
			
				$this->_autoHideMilliseconds = $autoHide;
			
			}
		
		}
		
		$flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
		
		$messages = $flashMessenger->getMessages();
		
		if (!count($messages)) 
		{
			
			return '';
			
		}
		
        $string = '<div id="flash_messenger">'."\n".
        	'<h3>Messages</h3>'."\n".
        	'<ul class="messages">'."\n";
        
        foreach ($messages as $message) {
            
            $string .= "<li>$message</li>\n";
            
        }
	
        $string .= "</ul>\n<div class=\"clear\"></div>\n</div>\n";
        
        $this->_addJavascript();
        
        return $string;
        
	}
	
	protected function _addJavascript() 
	{
		
		if (!$this->_javascriptAdded) 
		{
			
			$javascript = '$("#flash_messenger h3").append($("<a href=\"#\">Close</a>").click(function(){ $("#flash_messenger").hide(); return false; }));';
			
			if ($this->_autoHide) 
			{
				
				$javascript .= 'setTimeout("$(\'#flash_messenger\').fadeOut()",'.$this->_autoHideMilliseconds.');';
				
			}
			
			$javascript .= '$("body").prepend($("<a href=\"#\" id=\"flash_messenger_show\">Show Messages</a>").click(function(){ if (!$("#flash_messenger").is(":visible")) { $("#flash_messenger").show(); } return false; }));';	
		
			$this->view->JQuery()->addOnLoad($javascript);
			
			$this->_javascriptAdded = true;
	    
		}
		
	}
	
}