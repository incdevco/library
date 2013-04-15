<?php

class Inclusive_Form_Element_Picker extends Inclusive_Form_Element_Text
{
	
	public $helper = 'picker';
	
	public function init() 
	{
	
		parent::init();
		
		$this->addFilter(new Inclusive_Filter_StringToTime());
		
		$this->addValidator(new Zend_Validate_Float());
		
	}
	
	public function render(Zend_View_Interface $view = NULL)
	{
		
		$filters = $this->getFilters();
		
		$this->clearFilters();
		
		$value = $this->getValue();
		
		if (!empty($value))
		{
		
			$this->setValue(date(DATE_FORMAT,$value));
		
		}
		
		$result = parent::render();
		
		$this->setFilters($filters);
		
		return $result;
	
	}
	
}