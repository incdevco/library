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
		
		$mFunctions = "'isValid','isAllowed'";
		
		if ($function == 'edit' || $function == 'delete')
		{
		
			$mFunctions .= ",'fetchOne'";
		
		}
		
		$string .= '$service = $this->getMock("'.$module.'_Service_'.$model.'",array('.$mFunctions.'));';
		
		$string .= "\n\n\t\t".'$service';
		
		$string .= "\n\t\t\t".'->expects($this->once())';
		
		$string .= "\n\t\t\t".'->method("isValid")';
		
		$with = 'array()';
		
		if ($function == 'edit')
		{
		
			$with = "array('id'=>'1')";
		
		}
		
		$string .= "\n\t\t\t".'->with("'.ucfirst($function).'",'.$with.')';
		
		$string .= "\n\t\t\t".'->will($this->returnValue('.$with.'));';
		
		if ($function == 'fetchAll')
		{
		
			
		
		}
		else 
		{
			
			$privilege = $function;
			
			if ($function == 'fetchOne')
			{
			
				$privilege = 'view';
			
			}
			
			$string .= "\n\n\t\t".'$model = $service->createModel('.$with.');';
			
			if ($function == 'edit' || $function == 'delete')
			{
				
				$string .= "\n\n\t".'$service';
				
				$string .= "\n\t\t".'->expects($this->once())';
				
				$string .= "\n\t\t".'->method("fetchOne")';
				
				$string .= "\n\t\t".'->with('.$with.')';
				
				$string .= "\n\t\t".'->will($this->returnValue($model));';
				
			}
			
			$string .= "\n\n\t\t".'$service';
			
			$string .= "\n\t\t\t".'->expects($this->once())';
			
			$string .= "\n\t\t\t".'->method("isAllowed")';
			
			$string .= "\n\t\t\t".'->with($model,"'.$privilege.'")';
			
			$string .= "\n\t\t\t".'->will($this->returnValue(true));';
			
		}
		
		$aFunction = $function;
		
		if ($function == 'fetchOne')
		{
		
			$aFunction = 'fetchRow';
		
		}
		
		$string .= "\n\n\t\t".'$adapter = $this->getMock("'.$module.'_Service_'.$model.'_Adapter",array("'.$aFunction.'"));';
		
		$string .= "\n\n\t\t".'$adapter';
		
		$string .= "\n\t\t\t".'->expects($this->once())';
		
		$string .= "\n\t\t\t".'->method("'.$aFunction.'")';
		
		$with = 'array()';
		
		if ($function == 'edit')
		{
		
			$with = "array(),array('id'=>'1')";
		
		}
		
		$string .= "\n\t\t\t".'->with('.$with.')';
		
		$return = 'true';
		$assert = '$this->assertTrue($actual);';
		
		if ($function == 'fetchAll')
		{
		
			$return = 'new Zend_Db_Table_Rowset(array())';
			$assert = '$this->assertInstanceOf("'.$module.'_Set_'.$model.'",$actual);';
		
		}
		elseif ($function == 'fetchOne')
		{
		
			$return = 'new Zend_Db_Table_Row(array())';
			$assert = '$this->assertInstanceOf("'.$module.'_Model_'.$model.'",$actual);';
		
		}
		
		$string .= "\n\t\t\t".'->will($this->returnValue('.$return.'));';
		
		$string .= "\n\n\t\t".'$service->setAdapter($adapter);';
		
		$data = 'array()';
		
		if ($function == 'edit')
		{
		
			$data = "array('id'=>'1')";
		
		}
		
		$string .= "\n\n\t\t".'$actual = $service->'.$function.'('.$data.');';
		
		$string .= "\n\n\t\t".$assert;
		
		$string.= "\n\n\t}\n\n";
		
		return $string;
	
	}
	
	public static function save($file,$string)
	{
	
		return file_put_contents($file,$string);
	
	}

}