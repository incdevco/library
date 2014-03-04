<?php

class Inclusive_Test_Generator_Bootstrap
{

	public static function generate($module,$models)
	{
		
		$string = "<?php\n\nclass ".$module.'_BootstrapTest extends TestCase'."\n{\n\n\t";
		
		$string .= 'public function testInitAcl()';
		
		$string .= "\n\t{\n\n\t\tZend_Registry::set('acl',new Acl());";
		
		$string .= "\n\n\t\t".'$bootstrap = new '.$module.'_Bootstrap(new Inclusive_Application(APPLICATION_ENV,APPLICATION_PATH.\'/configs/application.ini\'));';
		
		$string .= "\n\n\t\t".'$bootstrap->_initAcl();';
		
		$string .= "\n\n\t\t".'$acl = Zend_Registry::get(\'acl\');';
		
		foreach ($models as $model => $functions)
		{
		
			$string .= "\n\n\t\t".'$this->assertTrue($acl->has(\''.$module.'_Model_'.$model.'\'));';
		
		}
		
		$string.= "\n\n\t}\n";
		
		$string.= "\n}\n";
		
		return $string;
	
	}
	
}