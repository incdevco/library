<?php

class Inclusive_CodeGenerator_Controller_Action
{
	
	protected $_controller = null;
	
	protected $_key = 'result';
	
	protected $_name = null;
	
	protected $_mock = null;
	
	protected $_service = null;
	
	public function __construct($controller,$name,$config=null)
	{
		
		$this
			->setController($controller)
			->setName($name);
		
		if (is_array($config))
		{
			
			if (isset($config['key']))
			{
			
				$this->setKey($config['key']);
			
			}
			
			if (isset($config['service']))
			{
			
				$this->setService($config['service']);
			
			}
			
			if (isset($config['mock']))
			{
			
				$this->setMock($config['mock']);
			
			}
			
		}
		
	}
	
	public function generate()
	{
	
		$string = "<?php";
		$string .= "\n\necho Zend_Json::encode(array(";
		$string .= "\n\t'success'=>\$this->success,";
		$string .= "\n\t'{$this->getKey()}'=>\$this->{$this->getKey()}";
		$string .= "\n));";
		
		return $string;
	
	}
	
	public function getController()
	{
	
		return $this->_controller;
	
	}
	
	public function getKey()
	{
	
		return $this->_key;
	
	}
	
	public function getMock()
	{
		
		return $this->_mock;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function getService()
	{
	
		return $this->_service;
	
	}
	
	public function setController(Inclusive_CodeGenerator_Controller $controller)
	{
	
		$this->_controller = $controller;
		
		return $this;
	
	}
	
	public function setKey($key)
	{
	
		$this->_key = $key;
		
		return $this;
	
	}
	
	public function setMock($mock)
	{
	
		$this->_mock = $mock;
		
		return $this;
		
	}
	
	public function setName($name)
	{
	
		$this->_name = $name;
		
		return $this;
		
	}
	
	public function setService($service)
	{
	
		$this->_service = $service;
		
		return $this;
		
	}
	
	public function toFunction()
	{
	
		$function = new Inclusive_CodeGenerator_Class_Function();
		$function
			->setVisibility('public')
			->setName($this->getName().'Action');
			
		$string = "\t\t\$result = \$this->getService('{$this->getService()}')"
			."\n\t\t\t->{$this->getName()}(\$this->getRequest()->getParams());"
			."\n\n\t\t\$this->view->success = true;"
			."\n\n\t\t\$this->view->{$this->getKey()} = \$result;\n";
		
		$function->setContent($string);
		
		return $function;
	
	}
	
	public function toTestFunction()
	{
	
		$function = new Inclusive_CodeGenerator_Class_Function();
		
		$function->setVisibility('public');
		
		$function->setName('test'.ucfirst($this->getName()).'Action');
		
		$serviceClass = $this->getController()->getService($this->getService());
		
		$expected = '1';
		$return = '1';
		
		if ($this->getMock())
		{
			
			$expected = $this->getMock()['expected'];
			$return = $this->getMock()['return'];
			
		}
		
		$string = "\t\t\$request = \$this->getRequest(); \$response = \$this->getResponse();\n\n"
			."\t\t\$controller = new {$this->getController()->getClassName()}(\$request,\$response);"
			."\n\n\t\t\$return = {$return};"
			."\n\t\t\$expected = {$expected};"
			."\n\n\t\t\$service = \$this->getMock('{$serviceClass}',array('{$this->getName()}'));"
			."\n\t\t\$service"
			."\n\t\t\t->expects(\$this->once())"
			."\n\t\t\t->method('{$this->getName()}')"
			."\n\t\t\t->with(array())"
			."\n\t\t\t->will(\$this->returnValue(\$return));"
			."\n\n\t\t\$controller->setService(\$service,'{$this->getService()}');"
			."\n\n\t\t\$controller->view = new Zend_View();"
			."\n\n\t\t\$controller->{$this->getName()}Action();"
			."\n\n\t\t\$this->assertTrue(\$controller->view->success);"
			."\n\n\t\t\$this->assertEquals(\$expected,\$controller->view->{$this->getKey()});\n";
		
		$function->setContent($string);
		
		return $function;
	
	}
	
}