<?php

class Inclusive_CodeGenerator_Service
{
	
	protected $_adapter = null;
	
	protected $_forms = array();
	
	protected $_functions = array();
	
	protected $_module = null;
	
	protected $_name = null;
	
	protected $_services = array();
	
	protected $_table = null;
	
	public function __construct($module,$name,$config=null)
	{
	
		$this
			->setModule($module)
			->setName($name);
			
		if (is_array($config))
		{
			
			if (isset($config['adapter']))
			{
			
				$this->setAdapter($config['adapter']);
			
			}
			
			if (isset($config['forms']))
			{
			
				$this->setForms($config['forms']);
			
			}
			
			if (isset($config['functions']))
			{
			
				$this->setFunctions($config['functions']);
			
			}
			
			if (isset($config['services']))
			{
			
				$this->setServices($config['services']);
			
			}
			
		}
	
	}
	
	public function addForm($key,$class)
	{
	
		$this->_forms[$key] = $class;
		
		return $this;
	
	}
	
	public function addFunction($name,$config=null)
	{
		
		$this->_functions[$name] = $config;
		
		return $this;
	
	}
	
	public function addService($key,$class)
	{
	
		$this->_services[$key] = $class;
		
		return $this;
	
	}
	
	public function generate()
	{
		
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setExtends('Application_Service')
			->setName($this->getClassName());
		
		$adapter = new Inclusive_CodeGenerator_Class_Variable();
		$adapter
			->setVisibility('protected')
			->setName('_adapterClass')
			->setDefault("'{$this->getClassName()}_Adapter'");
		
		$class->addVariable($adapter);
		
		$forms = "array(";
		
		foreach ($this->getForms() as $key => $form)
		{
		
			$forms .= "\n\t\t'{$key}'=>'{$form}',";
		
		}
		
		$forms = rtrim($forms,',');
		
		$forms .= "\n\t\t)";
		
		$variable = new Inclusive_CodeGenerator_Class_Variable();
		$variable
			->setName('_formClasses')
			->setVisibility('protected')
			->setDefault($forms);
		
		$class->addVariable($variable);
		
		$model = new Inclusive_CodeGenerator_Class_Variable();
		$modelName = preg_replace('/Service/','Model',$this->getClassName(),1);
		$model
			->setVisibility('protected')
			->setName('_modelClass')
			->setDefault("'{$modelName}'");
		
		$class->addVariable($model);
		
		$variable = new Inclusive_CodeGenerator_Class_Variable();
		$variable
			->setName('_serviceClasses')
			->setVisibility('protected');
		
		$string = "array(";
		
		foreach ($this->getServices() as $key => $serviceClass)
		{
		
			$string .= "\n\t\t'{$key}'=>'{$serviceClass}',";
		
		}
		
		$string = rtrim($string,',');
		
		$string .= "\n\t\t)";
		
		$variable->setDefault($string);
		
		$class->addVariable($variable);
		
		$set = new Inclusive_CodeGenerator_Class_Variable();
		$setName = preg_replace('/Service/','Set',$this->getClassName(),1);
		$set
			->setVisibility('protected')
			->setName('_setClass')
			->setDefault("'{$setName}'");
		
		$class->addVariable($set);
		
		foreach ($this->getFunctions() as $name => $config)
		{
			
			$string = "";
			
			if (isset($config['form']))
			{
			
				$string .= "\t\t\$clean = \$this->isValid('{$config['form']}',\$data);";
			
			}
			
			if (isset($config['fetch']))
			{
			
				if (isset($config['adapter']))
				{
					
					$result = 'result';
					$adapterString = '$clean';
					
					if ($config['fetch'] == 'all')
					{
					
						$result = 'results';
					
					}
					elseif ($config['fetch'] == 'not')
					{
						
						$result = 'results';
						$adapterString = '$select';
					
					}
					
					if (isset($config['select']))
					{

						$adapterString = '$select';
					
						$string .= "\n\n\t\t\$select = \$this->getAdapter()->select()";
						
						if (isset($config['select']['from']))
						{
						
							$string .= "\n\t\t\t->from('{$config['select']['from']['table']}','{$config['select']['from']['key']}')";
						
						}
						
						$string .= ";";
						
						if (isset($config['select']['from']['map']))
						{
						
							foreach ($config['select']['from']['map'] as $key => $value)
							{
								
								if ($value != null)
								{

									$string .= "\n\n\t\tif (isset(\$clean['{$value}']))";
									$string .= "\n\t\t{";

									if (preg_match('/\?/',$key))
									{

										$string .= "\n\n\t\t\t\$select->where('{$key}',\$clean['{$value}']);";
								
									}
									else
									{							

										$string .= "\n\n\t\t\t\$select->where('{$key} = ?',\$clean['{$value}']);";
	
									}								
	
									$string .= "\n\n\t\t}";
								
								}
								else
								{

									$string .= "\n\t\t\$select->where('{$key}');";

								}
							
							}
						
						}
						
						if (isset($config['select']['not']))
						{
						
							$string .= "\n\n\t\t\$select = \$this->getAdapter()->select()";
							$string .= "\n\t\t\t->setIntegrityCheck(false)";
							$string .= "\n\t\t\t->from('{$config['select']['not']['table']}','*')";
							$string .= "\n\t\t\t->where('{$config['select']['not']['key']} NOT IN ('.\$select->assemble().')');";
							
							if (isset($config['select']['not']['map']))
							{
							
								foreach ($config['select']['not']['map'] as $key => $value)
								{
								
									$string .= "\n\n\t\tif (isset(\$clean['{$value}']))";
									$string .= "\n\t\t{";
									$string .= "\n\n\t\t\t\$select->where('{$key} = ?',\$clean['{$value}']);";
									$string .= "\n\n\t\t}";
								
								}
							
							}
							
						}
					
					}
					
					$string .= "\n\n\t\t\${$result} = \$this->getAdapter()->{$config['adapter']}({$adapterString});";
					
					if ($config['fetch'] == 'all')
					{
					
						$string .= "\n\n\t\treturn \$this->buildSet(\$results,'{$config['privilege']}');";
					
					}
					elseif ($config['fetch'] == 'not')
					{
						
						$string .= "\n\n\t\t\$service = \$this->getService('{$config['service']}');";
						$string .= "\n\n\t\treturn \$service->buildSet(\$results,'{$config['privilege']}');";
					
					}
					elseif ($config['fetch'] == 'one')
					{
					
						$string .= "\n\n\t\tif (\$result)";
						$string .= "\n\t\t{";
						$string .= "\n\n\t\t\t\$model = \$this->createModel(\$result);";
						$string .= "\n\n\t\t\t\$this->isAllowed(\$model,'{$config['privilege']}');";
						$string .= "\n\n\t\t\treturn \$model;";
						$string .= "\n\t\t}";
						$string .= "\n\n\t\treturn \$this->_throw('No Model Found');";
					
					}
					
				}
			
			}
			else 
			{
				
				if (isset($config['createModel']))
				{
				
					$string .= "\n\n\t\t\$model = \$this->createModel(\$clean);";
				
				}
				
				if (isset($config['fetchModel']))
				{
				
					$string .= "\n\n\t\t\$model = \$this->fetchOne(\$clean);";
				
				}
				
				if (isset($config['privilege']))
				{
				
					$string .= "\n\n\t\t\$this->isAllowed(\$model,'{$config['privilege']}');";
				
				}
				
				if (isset($config['adapter']))
				{
				
					$adapterString = "\$clean";
					
					if ($config['adapter'] == 'edit')
					{
						
						$adapterString = "\$clean,\$where";
						
						$string .= "\n\n\t\t\$where = \$this->_where(\$clean);";
						
					}

					if (isset($config['preAdapter']))
					{

						$string .= $config['preAdapter'];

					}

					$returnAdapter = "return";			

					if (isset($config['postAdapter']))
					{

						$returnAdapter = "\$result =";

					}					

					$string .= "\n\n\t\t{$returnAdapter} \$this->getAdapter()->{$config['adapter']}({$adapterString});";
				
					if (isset($config['postAdapter']))
					{

						$string .= $config['postAdapter'];

						$string .= "\n\n\treturn \$result;";

					}

				}
				
			}
			
			$string .= "\n";
			
			$function = new Inclusive_CodeGenerator_Class_Function();
			$function
				->setName($name)
				->setVisibility('public')
				->setParameterString('array $data')
				->setContent($string);
			
			$class->addFunction($function);
		
		}
		
		return $class->generate();
		
	}
	
	public function generateAdapter()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setExtends('Inclusive_Service_Adapter_Table')
			->setName($this->getClassName().'_Adapter');
			
		$variable = new Inclusive_CodeGenerator_Class_Variable();
		$variable
			->setName('_tableClass')
			->setVisibility('protected')
			->setDefault("'{$this->getClassName()}_Table'");
		
		$class->addVariable($variable);
		
		return $class->generate();
	
	}
	
	public function generateTable()
	{
	
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setExtends('Inclusive_Db_Table_Abstract')
			->setName($this->getClassName().'_Table');
		
		$name = $this->getTable()['name'];
		
		$variable = new Inclusive_CodeGenerator_Class_Variable();
		$variable
			->setName('_name')
			->setVisibility('protected')
			->setDefault("'{$name}'");
		
		$class->addVariable($variable);
		
		$variable = new Inclusive_CodeGenerator_Class_Variable();
		$variable
			->setName('_primary')
			->setVisibility('protected')
			->setDefault("{$this->getPrimaryDefinition()}");
		
		$class->addVariable($variable);
		
		return $class->generate();
	
	}
	
	public function generateTest()
	{
		
		$class = new Inclusive_CodeGenerator_Class();
		$class
			->setName($this->getClassName().'Test')
			->setExtends('TestCase');
		
		foreach ($this->getFunctions() as $name => $config)
		{
			
			$mocked = "";
			$string = "";
			
			if (isset($config['form']))
			{
				
				$submitString = "array(";
				
				if (isset($config['fetch']))
				{
					
					if (isset($config['select']['from']['map']))
					{
						
						foreach ($config['select']['from']['map'] as $value)
						{
						
							$submitString .= "'$value'=>'1',";
						
						}
						
					}
					
					if (isset($config['select']['not']['map']))
					{
						
						foreach ($config['select']['not']['map'] as $value)
						{
						
							$submitString .= "'$value'=>'1',";
						
						}
						
					}
					
					$submitString = rtrim($submitString,',');
				
				}
				
				$submitString .= ")";

				$mocked .= "'isValid',";
				$string .= "\n\t\t\$service";
				$string .= "\n\t\t\t->expects(\$this->once())";
				$string .= "\n\t\t\t->method('isValid')";
				$string .= "\n\t\t\t->with('{$config['form']}',$submitString)";

				if (isset($config['isValidReturns']))				
				{

					$string .= "\n\t\t\t->will(\$this->returnValue({$config['isValidReturns']}));";

				}
				else
				{

					$string .= "\n\t\t\t->will(\$this->returnValue({$submitString}));";

				}
			
			}
			
			if (isset($config['createModel']))
			{
				
				if (isset($config['isValidReturns']))
                                {

                                        $string .= "\n\n\t\t\$model = \$service->createModel({$config['isValidReturns']});";

                                }
                                else
                                {

                                        $string .= "\n\n\t\t\$model = \$service->createModel(array());";

                                }				

			}
			
			if (isset($config['fetchModel']))
			{
				
				$mocked .= "'fetchOne',";

				if (isset($config['isValidReturns']))
				{

					$string .= "\n\n\t\t\$model = \$service->createModel({$config['isValidReturns']});";

				}
				else
				{				

					$string .= "\n\n\t\t\$model = \$service->createModel(array());";
				
				}
				
				$fetchModelExpects = "once()";

				if (isset($config['fetchModelExpects']))
				{

					$fetchModelExpects = $config['fetchModelExpects'];

				}

				$string .= "\n\n\t\t\$service";
				$string .= "\n\t\t\t->expects(\$this->{$fetchModelExpects})";
				$string .= "\n\t\t\t->method('fetchOne')";

				if (isset($config['isValidReturns']))
				{

					$string .= "\n\t\t\t->with({$config['isValidReturns']})";

				}
				else
				{

					$string .= "\n\t\t\t->with(array())";

				}
				
				$string .= "\n\t\t\t->will(\$this->returnValue(\$model));";
			
			}
				
			$returnValue = '1';
						
			if (isset($config['fetch']) && $config['fetch'] != 'one')
			{
				
				if ($config['fetch'] == 'all')
				{
					
					if (isset($config['select']))
					{

						$returnValue = 'array()';

					}

					$mocked .= "'buildSet',";
					
					$setClass = preg_replace('/_Service_/','_Set_',$this->getClassName());
					
					$string .= "\n\n\t\t\$service";
					$string .= "\n\t\t\t->expects(\$this->once())";
					$string .= "\n\t\t\t->method('buildSet')";
					$string .= "\n\t\t\t->with({$returnValue},'{$config['privilege']}')";
					$string .= "\n\t\t\t->will(\$this->returnValue(new {$setClass}()));";
					
				}
			
			}
			else 
			{
				
				if (isset($config['privilege']))
				{
					
					$mocked .= "'isAllowed',";
					
					$string .= "\n\n\t\t\$service";
					$string .= "\n\t\t\t->expects(\$this->once())";
					$string .= "\n\t\t\t->method('isAllowed')";
					$string .= "\n\t\t\t->with(\$model,'{$config['privilege']}')";
					$string .= "\n\t\t\t->will(\$this->returnValue(true));";
				
				}
				
			}
			
			$mocked = rtrim($mocked,',');
			
			$string = "\t\t\$service = \$this->getMock('{$this->getClassName()}',array({$mocked}));"
				.$string;

			$serviceSubmitString = 'array()';			

			if (isset($config['adapter']))
			{
				
				$adapterClass = $this->getClassName().'_Adapter';
				
				$withString = "array()";
				
				if ($config['adapter'] == 'edit')
				{
				
					$withString .= ",array()";
				
				}
				
				$string .= "\n\n\t\t\$adapter = \$this->getMock('{$adapterClass}',array('{$config['adapter']}'));";
				
				if (isset($config['fetch']))
				{
					
					if (isset($config['select']))
					{

						$returnValue = "array()";
						
						$withString = "\$select";
					
						$string .= "\n\n\t\t\$db = new Zend_Test_DbAdapter();";
						$string .= "\n\n\t\t\$db->setDescribeTable('{$config['select']['from']['table']}',array(";
						
						if (isset($config['select']['from']['tableColumns']))
						{

							foreach ($config['select']['from']['tableColumns'] as $column)
							{
	
								$string .= "\n\t\t\t'{$column}'=>array(),";

							}
	
							$string = rtrim($string,',');
						
						}
						else
						{
	
							$string .= "\n\t\t\t'{$config['select']['from']['key']}'=>array(),";

						}

						$string .= "\n\t\t\t));";
					
						$string .= "\n\n\t\tZend_Db_Table_Abstract::setDefaultAdapter(\$db);";
					
						$string .= "\n\n\t\t\$select = \$adapter->select()";
						$string .= "\n\t\t\t->from('{$config['select']['from']['table']}','{$config['select']['from']['key']}');";
						
						$serviceSubmitString = "array(";
											
						if (isset($config['select']['from']['map']))
						{

							foreach ($config['select']['from']['map'] as $key => $value)
							{
						
								if ($value != null)
								{

									if (preg_match('/\?/',$key))
									{

										$string .= "\$select->where('{$key}','1');";

									}
									else
									{

										$string .= "\$select->where('{$key} = ?','1');";

									}
									
									$serviceSubmitString .= "'{$value}'=>'1',";
									
								}
								else
								{

									$string .= "\n\t\t\$select->where('{$key}');";

								}
						
							}

							
					
						}

						if ($config['fetch'] == 'not' && isset($config['select']['not']))
						{					

							$string .= "\n\n\t\t\$select = \$adapter->select()";
							$string .= "\n\t\t\t->setIntegrityCheck(false)";
							$string .= "\n\t\t\t->from('{$config['select']['not']['table']}','*')";
							$string .= "\n\t\t\t->where('{$config['select']['not']['key']} NOT IN ('.\$select->assemble().')');\n";
					
							if (isset($config['select']['not']['map']))
							{
					
								foreach ($config['select']['not']['map'] as $key => $value)
								{
						
									$string .= "\$select->where('{$key} = ?','1');";
						
								}

								$serviceSubmitString .= "'{$value}'=>'1',";
					
							}
	
						}

						$serviceSubmitString = rtrim($serviceSubmitString,',');						

						$serviceSubmitString .= ")";
						
					}
					
				}

				if (isset($config['adapterExpects']))
				{

					$withString = $config['adapterExpects'];

				}

				if (isset($config['preAdapterTest']))
				{

					$string .= $config['preAdapterTest'];

				}				

				$string .= "\n\n\t\t\$adapter";
				$string .= "\n\t\t\t->expects(\$this->once())";
				$string .= "\n\t\t\t->method('{$config['adapter']}')";
				$string .= "\n\t\t\t->with({$withString})";
				$string .= "\n\t\t\t->will(\$this->returnValue({$returnValue}));";
				$string .= "\n\n\t\t\$service->setAdapter(\$adapter);";
			
				if (isset($config['postAdapterTest']))
                                {

                                        $string .= $config['postAdapterTest'];

                                }

			}
			
			$string .= "\n\n\t\t\$actual = \$service->{$name}({$serviceSubmitString});";
			
			if (isset($config['fetch']))
			{
				
				$expectedClass = '';
				
				if ($config['fetch'] == 'all')
				{
				
					$expectedClass = preg_replace('/_Service_/','_Set_',$this->getClassName());
				
				}
				elseif ($config['fetch'] == 'one')
				{
				
					$expectedClass = preg_replace('/_Service_/','_Model_',$this->getClassName());
				
				}
				elseif ($config['fetch'] == 'not')
				{
				
					$expectedClass = $config['select']['not']['test'];
				
				}
				
				$string .= "\n\n\t\t\$this->assertInstanceOf('{$expectedClass}',\$actual);";
			
			}
			else 
			{
				
				$expects = 'null';
				
				if (isset($config['adapter']))
				{
				
					$expects = "'1'";
				
				}
				
				$string .= "\n\n\t\t\$this->assertEquals({$expects},\$actual);";
				
			}
			
			$function = new Inclusive_CodeGenerator_Class_Function();
			$function
				->setName('test'.ucfirst($name))
				->setVisibility('public')
				->setContent($string);
			
			$class->addFunction($function);
			
			if (isset($config['fetch']) && $config['fetch'] == 'one')
			{
			
				$string = "\t\t\$service = \$this->getMock('{$this->getClassName()}',array('isValid'));";
				$string .= "\n\t\t\$service";
				$string .= "\n\t\t\t->expects(\$this->once())";
				$string .= "\n\t\t\t->method('isValid')";
				$string .= "\n\t\t\t->with('{$config['form']}',array())";
				$string .= "\n\t\t\t->will(\$this->returnValue(array()));";
				
				$string .= "\n\n\t\t\$adapter = \$this->getMock('{$this->getAdapterClassName()}',array('{$config['adapter']}'));";
				$string .= "\n\t\t\$adapter";
				$string .= "\n\t\t\t->expects(\$this->once())";
				$string .= "\n\t\t\t->method('{$config['adapter']}')";
				$string .= "\n\t\t\t->with(array())";
				$string .= "\n\t\t\t->will(\$this->returnValue(null));";
				
				$string .= "\n\n\t\t\$service->setAdapter(\$adapter);";
				$string .= "\n\n\t\ttry";
				$string .= "\n\t\t{";
				$string .= "\n\n\t\t\t\$service->{$name}(array());";
				$string .= "\n\n\t\t\t\$this->fail('Allowed {$name} When No Result');";
				$string .= "\n\t\t}";
				$string .= "\n\t\tcatch (Inclusive_Service_Exception \$e)";
				$string .= "\n\t\t{";
				$string .= "\n\n\t\t\t\$this->assertEquals('No Model Found',\$e->getMessage());";
				$string .= "\n\t\t}\n";
				
				$name = 'test'.ucfirst($name).'ThrowsException';
				
				$function = new Inclusive_CodeGenerator_Class_Function();
				$function
					->setName($name)
					->setVisibility('public')
					->setContent($string);
				
				$class->addFunction($function);
				
			}
		
		}
		
		return $class->generate();
	
	}
	
	public function getAdapter()
	{
	
		return $this->_adapter;
	
	}
	
	public function getAdapterClassName()
	{
	
		return $this->getClassName().'_Adapter';
	
	}
	
	public function getClassName()
	{
	
		return $this->getModule()->getName()
			.'_Service_'.$this->getName();
	
	}
	
	public function getForm($name)
	{
		
		if (!isset($this->_forms[$name]))
		{
		
			return false;
		
		}
		
		return $this->_forms[$name];
	
	}
	
	public function getForms()
	{
	
		return $this->_forms;
	
	}
	
	public function getFunctions()
	{
	
		return $this->_functions;
	
	}
	
	public function getPrimaryDefinition()
	{
	
		$string = "";
		
		if (isset($this->getTable()['primary']))
		{
			
			$string = "array(";
			
			foreach ($this->getTable()['primary'] as $key)
			{
			
				$string .= "'{$key}',";
			
			}
			
			$string = rtrim($string,',');
			
			$string .= ")";
		
		}
		
		return $string;
	
	}
	
	public function getModule()
	{
	
		return $this->_module;
	
	}
	
	public function getName()
	{
	
		return $this->_name;
	
	}
	
	public function getService($key)
	{
	
		return $this->_services[$key];
	
	}
	
	public function getServices()
	{
	
		return $this->_services;
	
	}
	
	public function getTable()
	{
	
		return $this->_table;
	
	}
	
	public function setAdapter($adapter)
	{
	
		$this->_adapter = $adapter;
		
		if (isset($adapter['table']))
		{
		
			$this->setTable($adapter['table']);
		
		}
		
		return $this;
	
	}
	
	public function setForms(array $forms)
	{
	
		$this->_forms = array();
		
		foreach ($forms as $key => $class)
		{
		
			$this->addForm($key,$class);
		
		}
		
		return $this;
	
	}
	
	public function setFunctions(array $functions)
	{
	
		$this->_functions = array();
		
		foreach ($functions as $name => $config)
		{
		
			$this->addFunction($name,$config);
		
		}
		
		return $this;
	
	}
	
	public function setModule(Inclusive_CodeGenerator_Module $module)
	{
	
		$this->_module = $module;
		
		return $this;
	
	}
	
	public function setName($name)
	{
	
		$this->_name = $name;
		
		return $this;
	
	}
		
	public function setServices(array $services)
	{
	
		$this->_services = array();
		
		foreach ($services as $key => $class)
		{
		
			$this->addService($key,$class);
		
		}
		
		return $this;
	
	}
	
	public function setTable($table)
	{
	
		$this->_table = $table;
		
		return $this;
	
	}
	
}
