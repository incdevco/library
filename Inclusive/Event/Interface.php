<?php

interface Inclusive_Event_Interface 
{
	
	public function getContext();
	
	public function getId();
	
	public function isActive();
	
	public function isExpired();
	
	public function isQueued();
	
}