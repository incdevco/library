<?php

abstract class Inclusive_Model_Abstract implements Zend_Acl_Resource_Interface
{
	
	protected $_deleted = false;
	
	protected $_form = null;
	
	protected $_formClass = null;
	
	protected $_modified = array();
	
	protected $_new = false;
	
	protected $_original = array();
	
	protected $_service = null;
	
	protected $_services = array();
	
	protected $_serviceMap = array();
	
	protected $_transaction = null;
	
	protected $_transformerMap = array();
	
	protected $_transformers = null;
	
	public function __construct(array $config=array()) 
	{
		
		if (isset($config['data']))
		{
			
			if (is_object($config['data']))
			{
			
				$config['data'] = $config['data']->toArray();
			
			}
			
			$this->_original = $config['data'];
			
		}
		
		if (isset($config['new']))
		{
		
			$this->_new = ($config['new']) ? true : false;
		
		}
		
		if (isset($config['service']))
		{
		
			$this->setService($config['service']);
		
		}
	
	}
	
	public function addTransformer(Inclusive_Model_Transformer_Abstract $transformer)
	{
	
		$this->getTransformers();
		
		$this->_transformers[] = $transformer;
		
		return $this;
	
	}
	
	public function deleted()
	{
	
		$this->_deleted = true;
		
		return $this;
	
	}
	
	public function get($key)
	{
	
		$array = $this->toArray();
		
		if (!isset($array[$key]))
		{
		
			return null;
		
		}
		
		return $array[$key];
		
	}
	
	public function getDiff()
	{
		
		$diff = false;
		
		$original = $this->getOriginal();
		
		$modified = $this->getModified();
		
		if (!empty($modified))
		{
			
			foreach ($modified as $key => $value)
			{
			
				if (!isset($original[$key]) || $value != $original[$key])
				{
				
					if (false === $diff)
					{
					
						$diff = array();
					
					}
				
					$diff[$key] = $value;
				
				}
			
			}
			
		}
		
		return $diff;
	
	}
	
	public function getForm()
	{
		
		if (null === $this->_form)
		{
		
			$class = $this->_formClass;
			
			$this->_form = new $class();
		
		}
		
		return $this->_form;
	
	}
	
	public function getModified($key=null)
	{
		
		if ($key)
		{
		
			return $this->_modified[$key];
		
		}
		
		return $this->_modified;
	
	}
	
	public function getOriginal($key=null)
	{
		
		if ($key)
		{
		
			return $this->_original[$key];
		
		}
		
		return $this->_original;
	
	}
	
	public function getPrimary()
	{
	
		$primary = array();
		
		$keys = $this->getService()->getAdapter()->getTable()->getPrimaryKey();
		
		foreach ($keys as $key)
		{
		
			$primary[$key] = $this->$key;
		
		}
		
		return $primary;
	
	}
	
	public function getResourceId()
	{
	
		return get_class($this);
	
	}
	
	public function getTransformers()
	{
	
		if (null === $this->_transformers)
		{
		
			$this->_transformers = array();
			
			foreach ($this->_transformerMap as $key => $config)
			{
				
				if (!isset($config['options']))
				{
				
					$config['options'] = array();
				
				}
				
				$transformer = new $config['class']($config['options']);
				
				$this->_transformers[] = $transformer;
			
			}
		
		}
		
		return $this->_transformers;
	
	}
	
	public function getService($key=null) 
	{
		
		if (null === $key)
		{
		
			return $this->_service;
			
		}
		
		if (!isset($this->_services[$key]))
		{
		
			$class = $this->_serviceMap[$key];
			
			$this->_services[$key] = Inclusive_Locator::service($class);
		
		}
		
		return $this->_services[$key];
		
	}
	
	public function isNew()
	{
	
		return $this->_new;
		
	}
	
	public function isValid($data)
	{
	
		$form = $this->getForm();
		
		$result = $form->isValid($data);
		
		if ($result)
		{
		
			return $form->getValues();
		
		}
		
		return $this->_throwNotValid($form);
	
	}
	
	public function reset()
	{
	
		$this->_modified = array();
		
		return $this;
	
	}
	
	public function save() 
	{
		
		$diff = $this->getDiff();
		
		if ($diff)
		{
			
			if ($this->isNew())
			{
			
				$id = $this->getService()->insert($this);
				
				$this->saved($id);
				
			}
			else 
			{
			
				$result = $this->getService()->update($this);
				
				if ($result)
				{
				
					$this->saved();
				
				}
				
			}
			
		}
		
	}
	
	public function saved($id=null)
	{
	
		if ($id)
		{
			
			$this->id = $id;
			
			$this->_new = false;
			
		}
		
		$this->_original = $this->toArray();
		
		$this->_modified = array();
		
		return $this;
	
	}
	
	public function set($key,$value)
	{
	
		$this->_modified[$key] = $value;
		
		return $this;
		
	}
	
	public function setForm(Inclusive_Form $form)
	{
		
		$this->_form = $form;
		
		return $this;
	
	}
	
	public function setFromArray(array $data) 
	{
	
		foreach ($data as $key => $value) 
		{
		
			$this->set($key,$value);
		
		}
		
		return $this;
	
	}
	
	public function setService($key,Inclusive_Service_Abstract $service=null) 
	{
		
		if ($key instanceof Inclusive_Service_Abstract)
		{
		
			$this->_service = $key;
			
		}
		else 
		{
		
			$this->_services[$key] = $service;
		
		}
		
		return $this;
	
	}
	
	public function toArray() 
	{
	
		return array_merge($this->_original,$this->_modified);
	
	}
	
	public function toJson(array $options=array())
	{
	
		$array = $this->toArray();
		
		if (in_array('returnArray',$options))
		{
		
			return $array;
		
		}
		
		return Zend_Json::encode($array);
	
	}
	
	public function transform(array $data)
	{
		
		$this->_start();
		
		try 
		{
		
			$this->_match($data);
			
			$this->_isAllowed($data);
			
			$this->_transform($data);
			
			$this->_commit();
		
		}
		catch (Inclusive_Exception $e)
		{
		
			$this->_rollback();
			
			throw $e;
		
		}
		
		return $this;
	
	}
	
	public function __get($key) 
	{
	
		return $this->get($key);
	
	}
	
	public function __isset($key)
	{
	
		return isset($this->_data[$key]);
	
	}
	
	public function __set($key,$value) 
	{
	
		return $this->set($key,$value);
		
	}
	
	protected function _commit()
	{
	
		return $this->_transaction->commit($this);
		
	}
	
	protected function _isAllowed()
	{
	
		foreach ($this->_transaction->getTransformers() as $transformer)
		{
		
			if (!$transformer->isAllowed())
			{
			
				throw new Inclusive_Model_Exception_NotAllowed($this,$transformer);
			
			}
		
		}
	
	}
	
	protected function _keyToFunction($type,$key)
	{
	
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
		
		return '_'.$type.$filter->filter($key);
	
	}
	
	protected function _match(array $data)
	{
	
		foreach ($this->getTransformers() as $transformer)
		{
		
			if ($transformer->match($this,$data))
			{
			
				$this->_transaction->addTransformer($transformer);
			
			}
		
		}
	
	}
	
	protected function _rollback()
	{
	
		return $this->_transaction->rollback($this);
	
	}
	
	protected function _start()
	{
	
		if (null === $this->_transaction)
		{
		
			$this->_transaction = new Inclusive_Model_Transaction();
		
		}
		
		return $this->_transaction->start();
		
	}
	
	protected function _throwNotAllowed($privilege)
	{
	
		throw new Inclusive_Model_Exception_NotAllowed($this,$privilege);
	
	}
	
	protected function _throwNotValid($form)
	{
	
		throw new Inclusive_Model_Exception_NotValid($this,$form);
	
	}
	
	protected function _transform(array $data)
	{
	
		foreach ($this->_transaction->getTransformers() as $transformer)
		{
		
			$transformer->transform($this,$data);
		
		}
	
	}
	
}