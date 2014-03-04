<?php

class Inclusive_Test_Generator_Form
{

	public static function generate($module,$model,$function,$elements=null)
	{
		
		$string = "<?php\n\nclass ".$module.'_Form_'.$model.'_'.ucfirst($function)."Test extends TestCase\n{\n\n\t";
		
		$string .= 'public function testCorrectElements()';
		
		$string .= "\n\t{\n\n\t\t".'$form = new '.$module.'_Form_'.$model.'_'.ucfirst($function).'();';
		
		if (null === $elements)
		{
		
			$elements = array();
		
		}
		
		$count = count($elements);
		
		$string .= "\n\n\t\t".'$this->assertEquals('.$count.',count($form->getElements()));';
		
		foreach ($elements as $key => $instance)
		{
			
			if (is_int($key))
			{
			
				$key = $instance;
				
				$instance = null;
			
			}
			
			if (null === $instance)
			{
			
				$instance = $module.'_Form_'.$model.'_Element_'.ucfirst(str_ireplace('_','',$key));
			
			}
			
			$string .= "\n\n\t\t".'$this->assertInstanceOf("'.$instance.'",$form->getElement("'.$key.'"),"'.$key.' is not instance of '.$instance.'");';
		
		}
		
		$string.= "\n\n\t}\n";
		
		$string.= "\n}\n";
		
		return $string;
	
	}
	
}