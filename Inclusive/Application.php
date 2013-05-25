<?php

require_once 'Zend/Application.php';
require_once 'Zend/Loader/Autoloader.php';

class Inclusive_Application extends Zend_Application
{

	public function __construct($environment, $options = null)
    {

        $this->_autoloader = Zend_Loader_Autoloader::getInstance();
		$this->_autoloader->registerNamespace('Inclusive');
		
        parent::__construct($environment,$options);
        
    }

}