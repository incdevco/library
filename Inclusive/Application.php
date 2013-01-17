<?php

require_once 'Zend/Application.php';

class Inclusive_Application extends Zend_Application
{

	public function __construct($environment, $options = null)
    {
        
        parent::__construct($environment,$options);
        
        $this->_autoloader->registerNamespace('Inclusive');
        
    }

}