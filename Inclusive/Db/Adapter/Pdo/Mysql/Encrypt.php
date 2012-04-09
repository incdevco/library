<?php

class Inclusive_Db_Adapter_Pdo_Mysql_Encrypt 
	extends Zend_Db_Adapter_Pdo_Mysql {
	
	protected $_defaultStmtClass = 'Inclusive_Db_Statement_Pdo_Encrypt';	
	
}