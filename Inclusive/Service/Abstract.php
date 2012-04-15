<?php

abstract Inclusive_Service_Abstract {
	
	protected $_name = null;
	
	protected $_primary = null;
	
	protected $_modelClass = 'Inclusive_Db_Table_Row';
	
	protected $_setClass = 'Inclusive_Db_Table_Rowset';
	
	protected $_adapterClass = 'Inclusive_Db_Table';
	
	protected $_adapter = null;

	public function __call($function,$args) {
	
		$adapter = $this->getAdapter();
	
		if (!method_exists($adapter, $function)) {
		
			throw new Inclusive_Service_Exception_FunctionNotImplemented($function,$adapter);
		
		}
		
		return $adapter->$function($args);
	
	}
	
	public function getAdapter() {
	
		if ($this->_adapter instanceof Inclusive_Service_Adapter_Interface) {
		
			return $this->_adapter;
		
		}
		
		$this->_adapter = new $this->_adapterClass(
			$this->_name,
			$this->primary,
			$this->_modelClass,
			$this->_setClass
			);
		
		return $this->_adapter;
	
	}

}