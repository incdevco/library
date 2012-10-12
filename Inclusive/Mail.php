<?php

class Inclusive_Mail extends Zend_Mail
{

	public function __construct($charset = 'UTF-8')
	{
	    
	    parent::__construct($charset);
	    
	}

}