<?php

require_once 'password.php';

class Inclusive_Crypt_Password 
{

	public function hash($password)
	{
	
		return password_hash($password);
	
	}
	
	public function verify($password,$hash)
	{
	
		return password_verify($password,$hash);
	
	}

}