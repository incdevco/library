<?php

class Inclusive_CodeGenerator_Service_Function
{
	
	protected $_adapterFunction = null;
	
	protected $_fetches = array(
		'fetchAll',
		'fetchAllNot',
		'fetchOne'
		);
	
	protected $_form = null;
	
	protected $_name = null;
	
	protected $_notServiceClass = null;
	
	protected $_notServiceKey = null;
	
	protected $_notTable = null;
	
	protected $_notTableKey = null;
	
	protected $_privilege = null;
	
	protected $_service = null;
	
	protected $_type = null;
	
	public function getAdapterFunction()
	{
	
		return $this->_adapterFunction;
		
	}
	
	public function getForm()
	{
	
		return $this->_form;
		
	}
	
	public function getName()
	{
	
		return $this->_name;
		
	}
	
	public function getNotServiceClass()
	{
	
		return $this->_notServiceClass;
		
	}
	
	public function getNotServiceKey()
	{
	
		return $this->_notServiceKey;
		
	}
	
	public function getNotTable()
	{
	
		return $this->_notTable;
		
	}
	
	public function getNotTableKey()
	{
	
		return $this->_notTableKey;
		
	}
	
	public function getPrivilege()
	{
	
		return $this->_privilege;
		
	}
	
	public function getService()
	{
	
		return $this->_service;
		
	}
	
	public function getType()
	{
	
		return $this->_type;
		
	}
	
	public function setAdapterFunction($function)
	{
	
		$this->_adapterFunction = $function;
		
		return $this;
	
	}
	
	public function setForm(Inclusive_CodeGenerator_Form $form)
	{
	
		$this->_form = $form;
		
		return $this;
	
	}
	
	public function setName($name)
	{
	
		$this->_name = $name;
		
		return $this;
	
	}
	
	public function setNotServiceClass($class)
	{
	
		$this->_notServiceClass = $class;
		
		return $this;
	
	}
	
	public function setNotServiceKey($key)
	{
	
		$this->_notServiceKey = $key;
		
		return $this;
	
	}
	
	public function setNotTable($table)
	{
	
		$this->_notTable = $table;
		
		return $this;
	
	}
	
	public function setNotTableKey($key)
	{
	
		$this->_notTableKey = $key;
		
		return $this;
	
	}
	
	public function setPrivilege($privilege)
	{
	
		$this->_privilege = $privilege;
		
		return $this;
	
	}
	
	public function setService(Inclusive_CodeGenerator_Service $service)
	{
	
		$this->_service = $service;
		
		return $this;
	
	}
	
	public function setType($type)
	{
	
		$this->_type = $type;
		
		return $this;
	
	}
	
	public function toFunction()
	{
	
		$function = new Inclusive_CodeGenerator_Class_Function();
		
		$function
			->setName($this->getName())
			->setVisibility('public')
			->setParameterString('array $data');
		
		$string = "\t\t\$clean = \$this->isValid('{$this->getForm()->getName()}',\$data);";
		
		if (in_array($this->getType(),$this->_fetches))
		{
		
			if ($this->getType() == 'fetchAll')
			{
				
				$string .= "\n\n\t\t\$results = \$this->getAdapter()->fetchAll(\$clean);";
				
				$string .= "\n\n\t\treturn \$this->buildSet(\$results,'{$this->getPrivilege()}');";
				
			}
			elseif ($this->getType() == 'fetchAllNot')
			{
				
				$string .= "\n\n\t\t\$select = \$this->getAdapter()->select()";
				$string .= "\n\t\t\t->from('{$this->getService()->getTable()}','{$this->getNotTableKey()}');";
				
				$string .= "\n\n\t\tforeach(\$clean as \$key => \$value)";
				$string .= "\n\t\t{";
				$string .= "\n\n\t\t\t\$select->where(\$key.' = ?',\$value);";
				$string .= "\n\n\t\t}";
				
				$string .= "\n\n\t\t\$select = \$this->getAdapter()->select()";
				$string .= "\n\t\t\t->setIntegrityCheck(false)";
				$string .= "\n\t\t\t->from('{$this->getNotTable()}','*')";
				$string .= "\n\t\t\t->where('id NOT IN ('.\$select->assemble().')');";
				
				$string .= "\n\n\t\t\$results = \$this->getAdapter()->fetchAll(\$select);";
				
				$string .= "\n\n\t\t\$service = \$this->getService('{$this->getNotServiceKey()}');";
				
				$string .= "\n\n\t\treturn \$service->buildSet(\$results,'{$this->getPrivilege()}');";
				
			}
			elseif ($this->getType() == 'fetchOne')
			{
				
				$string .= "\n\n\t\t\$result = \$this->getAdapter()->fetchRow(\$clean);";
				
				$string .= "\n\n\t\tif (\$result)\n\t\t{";
				
				$string .= "\n\n\t\t\t\$model = \$this->createModel(\$result);";
				
				$string .= "\n\n\t\t\t\$this->isAllowed(\$model,'{$this->getPrivilege()}');";
				
				$string .= "\n\n\t\t\treturn \$model;";
				
				$string .= "\n\n\t\t}";
				
				$string .= "\n\n\t\treturn \$this->_throw('No {$this->getService()->getName()} Found');";
				
			}
		
		}
		else 
		{
			
			$modelFunction = 'fetchOne';
			
			if ($this->getType() == 'add')
			{
			
				$modelFunction = 'createModel';
			
			}
			
			$string .= "\n\n\t\t\$model = \$this->{$modelFunction}(\$clean);";
			
			$string .= "\n\n\t\t\$this->isAllowed(\$model,'{$this->getPrivilege()}');";
			
			if ($this->getType() == 'edit')
			{
			
				$string .= "\n\n\t\t\$where = \$this->_where(\$clean);";
			
				$string .= "\n\n\t\treturn \$this->getAdapter()->{$this->getAdapterFunction()}(\$clean,\$where);";
			
			}
			else 
			{
			
				$string .= "\n\n\t\treturn \$this->getAdapter()->{$this->getAdapterFunction()}(\$clean);";
			
			}
			
		}
		
		$string .= "\n";
		
		$function->setContent($string);
		
		return $function;
	
	}
	
	public function toTestFunction()
	{
	
		$function = new Inclusive_CodeGenerator_Class_Function();
		$function
			->setName('test'.ucfirst($this->getName()))
			->setVisibility('public');
			
		$mockFunctions = "'isValid'";
		
		if ($this->getType() == 'fetchAll')
		{
			
			$mockFunctions .= ",'buildSet'";
			
			$string = "\t\t\$service = \$this->getMock('{$this->getService()->getClassName()}',array('isValid','buildSet'));";
		
		}
		elseif ($this->getType() == 'fetchAllNot')
		{
		
			
		
		}
		else 
		{
			
			$mockFunctions .= ",'isAllowed'";
			
			if ($this->getType() == 'delete' || $this->getType() == 'edit')
			{
			
				$mockFunctions .= ",'fetchOne'";
			
			}
			
		}
		
		$string = "\t\t\$service = \$this->getMock('{$this->getService()->getClassName()}',array({$mockFunctions}));";
		
		$string .= "\n\t\t\$service";
		
		if ($this->getType() == 'fetchOne')
		{
		
			$string .= "\n\t\t\t->expects(\$this->exactly(2))";
		
		}
		else 
		{
		
			$string .= "\n\t\t\t->expects(\$this->once())";
			
		}
		
		$string .= "\n\t\t\t->method('isValid')";
		
		$primaryString = "array()";
		
		if ($this->getType() == 'edit')
		{
			
			$primaryString = $this->getService()->getPrimaryArray();
			
		}
		
		$string .= "\n\t\t\t->with('{$this->getForm()->getName()}',{$primaryString})";
		
		$string .= "\n\t\t\t->will(\$this->returnValue({$primaryString}));";
		
		if ($this->getType() == 'add' || $this->getType() == 'delete' || $this->getType() == 'edit')
		{
		
			$string .= "\n\n\t\t\$model = \$service->createModel({$primaryString});";
		
		}
		
		if ($this->getType() == 'delete' || $this->getType() == 'edit')
		{
		
			$string .= "\n\n\t\t\$service";
			$string .= "\n\t\t\t->expects(\$this->once())";
			$string .= "\n\t\t\t->method('fetchOne')";
			$string .= "\n\t\t\t->with({$primaryString})";
			$string .= "\n\t\t\t->will(\$this->returnValue(\$model));";
		
		}
		
		if ($this->getType() == 'fetchAll')
		{
			
			$setClass = str_replace('_Service_','_Set_',$this->getService()->getClassName());
			
			$string .= "\n\n\t\t\$set = new Zend_Db_Table_Rowset(array());";
			$string .= "\n\n\t\t\$service";
			$string .= "\n\t\t\t->expects(\$this->once())";
			$string .= "\n\t\t\t->method('buildSet')";
			$string .= "\n\t\t\t->with(\$set,'{$this->getPrivilege()}')";
			$string .= "\n\t\t\t->will(\$this->returnValue(new {$setClass}(\$service,array())));";
			
		}
		elseif ($this->getType() == 'fetchAllNot')
		{
		
			
		
		}
		else 
		{
			
			if ($this->getType() == 'fetchOne')
			{
				
				$modelClass = str_replace('_Service_','_Model_',$this->getService()->getClassName());
				$string .= "\n\n\t\t\$model = \$service->createModel();";
				
			}
			
			$string .= "\n\n\t\t\$service";
			$string .= "\n\t\t\t->expects(\$this->once())";
			$string .= "\n\t\t\t->method('isAllowed')";
			$string .= "\n\t\t\t->with(\$model,'{$this->getPrivilege()}')";
			$string .= "\n\t\t\t->will(\$this->returnValue(true));";
			
		}
		
		$string .= "\n\n\t\t\$adapter = \$this->getMock('{$this->getService()->getClassName()}_Adapter',array('{$this->getAdapterFunction()}'));";
		
		if ($this->getType() == 'fetchAllNot')
		{
			
			$string .= "\n\n\t\t\$db = new Zend_Test_DbAdapter();";
			$string .= "\n\n\t\t\$db->setDescribeTable('{$this->getService()->getTable()}',array(";
			
			foreach ($this->getService()->getPrimary() as $primaryKey)
			{
			
				$string .= "\n\t\t\t'{$primaryKey}'=>array(),";
			
			}
			
			$string .= "\n\t\t\t));";
			
			$string .= "\n\n\t\tZend_Db_Table_Abstract::setDefaultAdapter(\$db);";
			
			$string .= "\n\n\t\t\$select = \$adapter->select()";
			$string .= "\n\t\t\t->from('{$this->getService()->getTable()}','{$this->getNotTableKey()}');";
			
			$string .= "\n\n\t\t\$select = \$adapter->select()";
			$string .= "\n\t\t\t->setIntegrityCheck(false)";
			$string .= "\n\t\t\t->from('{$this->getNotTable()}','*')";
			$string .= "\n\t\t\t->where('id NOT IN ('.\$select->assemble().')');\n";
			
		}
		
		$string .= "\n\t\t\$adapter";
		
		if ($this->getType() == 'fetchOne')
		{
		
			$string .= "\n\t\t\t->expects(\$this->at(0))";
		
		}
		else 
		{
		
			$string .= "\n\t\t\t->expects(\$this->once())";
		
		}
		
		$string .= "\n\t\t\t->method('{$this->getAdapterFunction()}')";
		
		if ($this->getType() == 'edit')
		{
		
			$string .= "\n\t\t\t->with(array(),{$primaryString})";
			
		}
		elseif ($this->getType() == 'fetchAllNot')
		{
		
			$string .= "\n\t\t\t->with(\$select)";
		
		}
		else 
		{
		
			$string .= "\n\t\t\t->with(array())";
		
		}
		
		if ($this->getType() == 'fetchAll' || $this->getType() == 'fetchAllNot')
		{
		
			$string .= "\n\t\t\t->will(\$this->returnValue(new Zend_Db_Table_Rowset(array())));";
		
		}
		elseif ($this->getType() == 'fetchOne')
		{
		
			$string .= "\n\t\t\t->will(\$this->returnValue(new Zend_Db_Table_Row(array())));";
			
			$string .= "\n\n\t\t\$adapter";
			$string .= "\n\t\t->expects(\$this->at(1))";
			$string .= "\n\t\t->method('{$this->getAdapterFunction()}')";
			$string .= "\n\t\t->with(array())";
			$string .= "\n\t\t->will(\$this->returnValue(null));";
		
		}
		else 
		{
		
			$string .= "\n\t\t\t->will(\$this->returnValue('1'));";
			
		}
		
		$string .= "\n\n\t\t\$service->setAdapter(\$adapter);";
		$string .= "\n\n\t\t\$result = \$service->{$this->getName()}({$primaryString});";
		
		if ($this->getType() == 'fetchAll')
		{
		
			$string .= "\n\n\t\t\$this->assertInstanceOf('{$setClass}',\$result);";
		
		}
		elseif ($this->getType() == 'fetchAllNot')
		{
			
			$setClass = preg_replace('/_Service_/','_Set_',$this->getNotServiceClass());
			
			$string .= "\n\n\t\t\$this->assertInstanceOf('{$setClass}',\$result);";
		
		}
		elseif ($this->getType() == 'fetchOne')
		{
		
			$string .= "\n\n\t\t\$this->assertInstanceOf('{$modelClass}',\$result);";
			
			$string .= "try\n{";
			$string .= "\n\n\t\$service->fetchOne(array());";
			$string .= "\n\n\t\$this->fail('Allowed FetchOne With No Result');";
			$string .= "\n\n\t}";
			$string .= "\n\tcatch (Inclusive_Service_Exception \$e)";
			$string .= "\n\t{";
			$string .= "\n\n\t\t\$this->assertTrue(true);";
			$string .= "\n\n\t}";
		
		}
		else 
		{
			
			$string .= "\n\n\t\t\$this->assertEquals('1',\$result);";
		
		}
		
		$string .= "\n";
		
		$function->setContent($string);
		
		return $function;
	
	}

}