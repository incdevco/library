<?php

class Inclusive_Form_Element_Picker extends Inclusive_Form_Element_Text
{
	
	public $helper = 'picker';
	
	protected $_formatConstant = 'DATETIME_FORMAT';
	
	protected $_returnTimestamp = true;
	
	public function init() 
	{
	
		parent::init();
		
		if ($this->_returnTimestamp)
		{
			
			$this->addFilter(new Inclusive_Filter_StringToTime());
			
			$this->addValidator(new Zend_Validate_Float());
			
		}
		
	}
	
	public function render(Zend_View_Interface $view = NULL)
	{
		
		$filters = $this->getFilters();
		
		$this->clearFilters();
		
		$value = $this->getValue();
		
		if (!empty($value)
			&& (string) (int) $value === $value
			&& $value <= PHP_INT_MAX
			&& $value >= ~PHP_INT_MAX)
		{
		
			$format = constant($this->_formatConstant);
			
			$this->setValue(date($format,$value));
			
		}
		
		$result = parent::render();
		
		$this->setFilters($filters);
		
		return $result;
	
	}
	
}