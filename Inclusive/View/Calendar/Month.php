<?php

class Inclusive_View_Calendar_Month extends Inclusive_View_Calendar 
{
	
	protected $_weeks = array();
	
	public function __construct($current,$options=null)
	{
	
		parent::__construct($current,$options);
		
		$this->build();
	
	}
	
	public function build()
	{
	
		$year = date('Y',$this->current);
		
		$month = date('m',$this->current);
	
		$this->start = strtotime($year.'-'.$month.'-1');
		
		if ($month == 12)
		{
		
			$month = 0;
			
			$year += 1;
		
		}
		
		$this->finish = strtotime($year.'-'.($month+1).'-1') - 1;
		
		$finish = (6 - date('w',$this->finish)) * $this->_secondsInADay;
		
		// First Week
		
		for ($i = $this->start; $i < ($this->finish + $finish); $i+=$this->_secondsInAWeek) 
		{
			
			$this->_weeks[] = 
				new Inclusive_View_Calendar_Week($i,$this->options);
			
		}
	
	}
	
	public function getWeeks()
	{
	
		return $this->_weeks;
	
	}
	
}