<?php

class Inclusive_Test_Generator_Controller
{

	public static function generate($module,$model,array $functions)
	{
	
		$string = "<?php\n\nrequire_once APPLICATION_PATH.'/modules/".strtolower($module)."/controllers/".str_ireplace('_','',$model)."Controller.php';";
		
		$string .= "\n\nclass ".$module.'_'.str_ireplace('_','',$model).'ControllerTest extends ControllerTestCase';
		
		$string .= "\n{\n\n";
		
		foreach ($functions as $function => $elements)
		{
			
			$string .= self::generateAction($function,$module,$model);
		
		}
		
		$string .= "}\n";
		
		return $string;
	
	}
	
	public static function generateAction($function,$module,$model)
	{
		
		$string = "\tpublic function test".ucfirst($function)."Action()\n\t{\n\n\t\t";
		
		$string .= '$request = $this->getRequest();'."\n\n\t\t".'$response = $this->getResponse();';
		
		$string .= "\n\n\t\t".'$controller = new '.$module.'_'.str_ireplace('_','',$model).'Controller($request,$response);';
		
		$string .= "\n\n\t\t".'$service = $this->getMock(\''.$module.'_Service_'.$model.'\',array(\''.$function.'\'));';
		
		$string .= "\n\n\t\t".'$service';
		
		$string .= "\n\t\t\t".'->expects($this->once())';
		
		$string .= "\n\t\t\t".'->method("'.$function.'")';
		
		$string .= "\n\t\t\t".'->with(array())';
		
		$equals = 1;
		$return = 1;
		$result = 'result';
		
		if ($function == 'add')
		{
		
			$result = 'id';
		
		}
		elseif ($function == 'fetchAll')
		{
		
			$return = 'new '.$module.'_Set_'.$model.'($service,array())';
			$result = strtolower($model).'s';
			$equals = 'array()';
		
		}
		elseif ($function == 'fetchOne')
		{
		
			$return = 'new '.$module.'_Model_'.$model.'($service,array())';
			$result = strtolower($model);
			$equals = 'array()';
		
		}
		
		$string .= "\n\t\t\t".'->will($this->returnValue('.$return.'));';
		
		$string .= "\n\n\t\t".'$controller->setService($service,"'.str_ireplace('_','',$model).'");';
		
		$string .= "\n\n\t\t".'$controller->view = new Zend_View();';
		
		$string .= "\n\n\t\t".'$controller->'.$function.'Action();';
		
		$string .= "\n\n\t\t".'$this->assertTrue($controller->view->success);';
		
		$string .= "\n\n\t\t".'$this->assertEquals('.$equals.',$controller->view->'.$result.');';
		
		$string.= "\n\n\t}\n\n";
		
		return $string;
	
	}
	
	public static function save($file,$string)
	{
	
		return file_put_contents($file,$string);
	
	}

}