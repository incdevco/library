<?php

class Inclusive_StaticSite_Generator 
{
	
	protected $_layout = null;
	
	protected $_pages = array();
	
	protected $_view = null;
	
	public function __construct($options=null)
	{
		
		if (isset($options['Layout']))
		{
		
			$this->setLayout($options['Layout']);
		
		}
		
		if (isset($options['Pages']))
		{
		
			$this->setPages($options['Pages']);
		
		}
		
		if (isset($options['View']))
		{
		
			$this->setView($options['View']);
		
		}
		
	}
	
	public function addPage($page)
	{
	
		if (is_array($page))
		{
		
			$page = new Inclusive_StaticSite_Page($page);
		
		}
		
		$this->_pages[] = $page;
		
		return $this;
	
	}
	
	public function addPages(array $pages)
	{
	
		foreach ($pages as $page)
		{
		
			$this->addPage($page);
		
		}
		
		return $this;
	
	}
	
	public function getLayout()
	{
	
		if ($this->_layout === null)
		{
		
			$this->_layout = new Zend_Layout();
			
		}
		
		return $this->_layout;
	
	}
	
	public function getPages()
	{
	
		return $this->_pages;
	
	}
	
	public function getView()
	{
	
		if ($this->_view === null)
		{
		
			$this->_view = new Zend_View();
		
		}
		
		return $this->_view;
	
	}
	
	public function setLayout(Zend_Layout $layout)
	{
	
		$this->_layout = $layout;
		
		return $this;
	
	}
	
	public function setPages(array $pages)
	{
	
		$this->_pages = $pages;
		
		return $this;
	
	}
	
	public function setView(Zend_View $view)
	{
	
		$this->_view = $view;
		
		return $this;
		
	}
	
}