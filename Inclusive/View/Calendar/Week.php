<?php

class Inclusive_View_Calendar_Week extends Inclusive_View_Calendar 
{
	
	protected $_days = array();
	
	public function __construct($current,$options=null)
	{
	
		parent::__construct($current,$options);
		
		$this->build();
	
	}
	
	public function build()
	{
	
		$dayOfWeek = date('w',$this->current);
		
		$this->start = $this->current - ($dayOfWeek * $this->_secondsInADay);
		
		$this->previous = $this->start - 100;
			
		$this->finish = $this->start + $this->_secondsInAWeek;
		
		$this->next = $this->finish + 100;
		
		for ($i = $this->start; $i < $this->finish; $i+=$this->_secondsInADay) 
		{
		
			$this->_days[] = new Inclusive_View_Calendar_Day($i,$this->options);
			
		}
	
	}
	
	public function getDays()
	{
	
		return $this->_days;
		
	}
	
}