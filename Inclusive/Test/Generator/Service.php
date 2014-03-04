<?php

class Inclusive_Test_Generator_Service
{

	public static function generate($module,$model,array $functions)
	{
	
		$string = "<?php\n\nclass ".$module.'_Service_'.$model.'Test extends TestCase';
		
		$string .= "\n{\n\n";
		
		foreach ($functions as $function => $elements)
		{
			
			$string .= self::generateFunction($module,$model,$function);
		
		}
		
		$string .= "}\n";
		
		return $string;
	
	}
	
	public static function generateFunction($module,$model,$function)
	{
		
		$string = "\tpublic function test".ucfirst($function)."()\n\t{\n\n\t\t";
		
		$string .= '$service = $this->getMock("'.$module.'_Service_'.$model.'",array("isValid","isAllowed"));';
		
		$string .= "\n\n\t\t".'$service';
		
		$string .= "\n\t\t\t".'->expects($this->once())';
		
		$string .= "\n\t\t\t".'->method("isValid")';
		
		$string .= "\n\t\t\t".'->with("'.ucfirst($function).'",array())';
		
		$string .= "\n\t\t\t".'->will($this->returnValue(array()));';
		
		$string .= "\n\n\t\t".'$model = $service->createModel(array());';
		
		$string .= "\n\n\t\t".'$service';
		
		$string .= "\n\t\t\t".'->expects($this->once())';
		
		$string .= "\n\t\t\t".'->method("isAllowed")';
		
		$string .= "\n\t\t\t".'->with($model,"'.$function.'")';
		
		$string .= "\n\t\t\t".'->will($this->returnValue(true));';
		
		$string .= "\n\n\t\t".'$adapter = $this->getMock("'.$module.'_Service_'.$model.'_Adapter",array("'.$function.'"));';
		
		$string .= "\n\n\t\t".'$adapter';
		
		$string .= "\n\t\t\t".'->expects($this->once())';
		
		$string .= "\n\t\t\t".'->method("'.$function.'")';
		
		$string .= "\n\t\t\t".'->with(array())';
		
		$string .= "\n\t\t\t".'->will($this->returnValue(true));';
		
		$string .= "\n\n\t\t".'$service->setAdapter($adapter);';
		
		$string .= "\n\n\t\t".'$actual = $service->'.$function.'(array());';
		
		$string .= "\n\n\t\t".'$this->assertTrue($actual);';
		
		$string.= "\n\n\t}\n\n";
		
		return $string;
	
	}
	
	public static function save($file,$string)
	{
	
		return file_put_contents($file,$string);
	
	}

}