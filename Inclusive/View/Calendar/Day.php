<?php

class Inclusive_View_Calendar_Day extends Inclusive_View_Calendar 
{
	
	public function __construct($current,$options=null)
	{
	
		parent::__construct($current,$options);
		
		$this->build();
	
	}
	
	public function build()
	{
	
		$this->start = strtotime(date('Y-m-d',$this->current));
		
		$this->finish = $this->start + $this->_secondsInADay;
	
	}
	
}