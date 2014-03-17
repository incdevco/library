<?php

class Inclusive_CodeGenerator_Module_Bootstrap
{
	
	protected $_module = null;
	
	public function generate()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setExtends('Inclusive_Application_Module_Bootstrap')
			->setName($this->getClassName());
			
		if (count($this->getModule()->getModels()))
		{
			
			$string = "\t\t\$acl = Zend_Registry::get('acl');\n";
			
			foreach ($this->getModule()->getModels() as $name => $config)
			{
				
				$model = new Inclusive_CodeGenerator_Model($this->getModule(),$name,$config);
				
				$string .= "\n\t\t\$acl->addResource('{$model->getClassName()}');";
				
				// Rules From Model
			
			}
			
			$string .= "\n";
			
			$function = new Inclusive_CodeGenerator_Class_Function();
			$function
				->setName('_initAcl')
				->setVisibility('public')
				->setContent($string);
				
			$class->addFunction($function);
			
		}
		
		return $class->generate();
		
	}
	
	public function generateTest()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setExtends('TestCase')
			->setName($this->getClassName().'Test');
		
		if (count($this->getModule()->getModels()))
		{
			
			$string = "\t\tZend_Registry::set('acl',new Acl());";
			
			$string .= "\n\n\t\t\$bootstrap = new {$this->getClassName()}(new Inclusive_Application(APPLICATION_ENV,APPLICATION_PATH.'/configs/application.ini'));";
			$string .= "\n\t\t\$bootstrap->bootstrap();";
			
			$string .= "\n\n\t\t\$acl = Zend_Registry::get('acl');\n";
			
			foreach ($this->getModule()->getModels() as $name => $config)
			{
				
				$model = new Inclusive_CodeGenerator_Model($this->getModule(),$name,$config);
				
				$string .= "\n\t\t\$this->assertTrue(\$acl->has('{$model->getClassName()}'));";
				
				// Rules From Model
			
			}
			
			$string .= "\n";
			
			$function = new Inclusive_CodeGenerator_Class_Function();
			$function
				->setName('testAclHasModels')
				->setVisibility('public')
				->setContent($string);
				
			$class->addFunction($function);
			
		}
		
		return $class->generate();
		
	}
	
	public function getClassName()
	{
	
		return $this->getModule()->getName().'_Bootstrap';
	
	}
	
	public function getModule()
	{
	
		return $this->_module;
	
	}
	
	public function setModule(Inclusive_CodeGenerator_Module $module)
	{
	
		$this->_module = $module;
		
		return $this;
	
	}

}