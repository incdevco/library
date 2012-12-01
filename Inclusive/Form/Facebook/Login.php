<?php

class Inclusive_Form_Facebook_Login extends Inclusive_Form
{

	public function init()
	{
	
		$this
			->addElement(new Inclusive_Form_Element_Hidden('code'))
			->addElement(new Inclusive_Form_Element_Hidden('state'));
	
	}

}