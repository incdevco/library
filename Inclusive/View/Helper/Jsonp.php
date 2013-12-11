<?php

class Inclusive_View_Helper_Jsonp extends Zend_View_Helper_Abstract
{

	public function jsonp($response)
	{
		
		if (!is_string($response))
		{
			
			if (is_array($response))
			{
			
				$response = $this->encodeArray($response);
			
			}
			
			$response = json_encode($response);
		
		}
		
		$request = Zend_Controller_Front::getInstance()->getRequest();
		
		if ($request)
		{
		
			$callback = $request->getParam('callback');
		
		}
		
		if (isset($_GET['callback']))
		{
		
			$callback = $_GET['callback'];
		
		}
		
		if (isset($_POST['callback']))
		{
		
			$callback = $_POST['callback'];
		
		}
		
		if (!isset($callback))
		{
		
			$callback = 'inclusive_jsonp_callback';
		
		}
		
		return $callback.' ( '.$response.' )';
	
	}
	
	public function encodeArray(array $array)
	{
	
		foreach ($array as $key => $value) 
		{
		
			if (is_array($value))
			{
			
				$value = $this->encodeArray($value);
			
			}
			else 
			{
			
				$value = utf8_encode($value);
			
			}
			
			$array[$key] = $value;
		
		}
		
		return $array;
	
	}

}