<?php

class Inclusive_Db_Table extends Inclusive_Db_Table_Abstract {

	protected $_name = null;
	
	protected $_primary = null;
	
	protected $_rowClass = null;
	
	protected $_rowsetClass = null;
	
	public function __construct($name,$primary=null,$rowClass=null,$setClass=null) {
	
		parent::__construct(array(
			'name'=>$name,
			'primary'=>$primary,
			'rowClass'=>$rowClass,
			'rowsetClass'=>$setClass
			));
	
	}

}