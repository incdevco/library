<?php

require_once '../library/Inclusive/Test/Generator/Bootstrap.php';
require_once '../library/Inclusive/Test/Generator/Controller.php';
require_once '../library/Inclusive/Test/Generator/Form.php';
require_once '../library/Inclusive/Test/Generator/Service.php';

class Inclusive_Test_Generator_Module
{

	public static function generate($module,array $models)
	{
	
		// Bootstrap
		
		$base = './'.strtolower($module);
		
		if (!file_exists($base))
		{
		
			mkdir($base);
		
		}
		
		if (!file_exists($base.'/controllers'))
		{
		
			mkdir($base.'/controllers');
		
		}
		
		if (!file_exists($base.'/forms'))
		{
		
			mkdir($base.'/forms');
		
		}
		
		if (!file_exists($base.'/services'))
		{
		
			mkdir($base.'/services');
		
		}
		
		foreach ($models as $model => $functions)
		{
		
			$string = Inclusive_Test_Generator_Controller::generate($module,$model,$functions);
			
			file_put_contents($base.'/controllers/'.$model.'ControllerTest.php',$string);
			
			if (!file_exists($base.'/forms/'.$model))
			{
			
				mkdir($base.'/forms/'.$model);
			
			}
			
			foreach ($functions as $function => $elements)
			{
			
				$string = Inclusive_Test_Generator_Form::generate($module,$model,$function,$elements);
				
				file_put_contents($base.'/forms/'.$model.'/'.ucfirst($function).'Test.php',$string);
			
			}
			
			Inclusive_Test_Generator_Service::generate($module,$model,$functions);
			
			file_put_contents($base.'/services/'.$model.'Test.php',$string);
			
		}
		
		return "done\n";
		
	}
	
}