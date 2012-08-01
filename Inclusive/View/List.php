<?php

class Inclusive_View_List
{

	protected $_class = '';

	protected $_items = array();
	
	protected $_itemClass = 'Inclusive_View_List_Item';
	
	public function __construct($options=null)
	{
	
		if (isset($options['class']))
		{
		
			$this->_class = $options['class'];
			
		}
	
	}
	
	public function addItem($item,$options=null)
	{
	
		if (!($item instanceof $this->_itemClass))
		{
		
			$item = new $this->_itemClass($item);
		
		}
		
		$this->_items[] = $item;
		
	}
	
	public function getClass()
	{
	
		return $this->_class;
		
	}
	
	public function getItems()
	{
	
		return $this->_items;
	
	}

}