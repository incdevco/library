<?php

class Inclusive_View_Calendar 
{
	
	public $current = null;
	
	public $finish = null;
	
	public $next = null;
	
	protected $options = null;
	
	public $previous = null;
	
	protected $_secondsInADay = 86400;
	
	protected $_secondsInAnHour = 3600;
	
	protected $_secondsInAWeek = 604800;
	
	public $start = null;
	
	public function __construct($current,$options=null)
	{
	
		$this->current = $current;
		
		$this->options = $options;
	
	}
	
	public function getFinish()
	{
	
		return $this->finish;
	
	}
	
	public function getMonth()
	{
	
		return new Inclusive_View_Calendar_Month(
			$this->current,
			$this->options
			);
	
	}
	
	public function getStart()
	{
	
		return $this->start;
	
	}
	
	public function getWeek()
	{
	
		return new Inclusive_View_Calendar_Week(
			$this->current,
			$this->options
			);
	
	}
	
	public function setCurrent($current)
	{
	
		$this->current = $current;
		
		return $this;
	
	}
	
	public function setOptions($options=null)
	{
	
		$this->options = $options;
		
		return $this;
	
	}
	
}