<?php

interface Inclusive_Event_Queue_Adapter_Interface
{
	
	public function activate();
	
	public function add();
	
	public function delete();
	
	public function expire();
	
	public function fetch();
	
	public function wait();
	
}