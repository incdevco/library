<?php

class Inclusive_Db_Adapter_Pdo_Sqlite extends Zend_Db_Adapter_Pdo_Sqlite {
	
	protected function _connect() {
		
		/*
         * if we already have a PDO object, no need to re-connect.
         */
        if ($this->_connection) {
            return;
        }

        parent::_connect();

        $retval = $this->_connection->exec('PRAGMA foreign_keys=1');
        if ($retval === false) {
            $error = $this->_connection->errorInfo();
            /** @see Zend_Db_Adapter_Exception */
            require_once 'Zend/Db/Adapter/Exception.php';
            throw new Zend_Db_Adapter_Exception($error[2]);
        }
		
	}
	
}