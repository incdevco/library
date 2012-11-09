<?php

class Inclusive_Form_Twitter_Login extends Inclusive_Form
{

	public function init()
	{
	
		$this->addElement(new Inclusive_Form_Element_Hidden('oauth_verifier'));
	
	}

}