<?php

class Inclusive_Git_Repository {
	
	protected $_location = null;
	
	protected $_executable = null;
	
	protected $_folder = null;
	
	public function __construct($executable,$location,$cloneUrl=null) {
		
		$this->_executable = $executable;
		
		$this->_location = $location;
		
		if (!is_dir($location)
		    && $cloneUrl) {
			
			$command = 'cd '.dirname($this->_location).' && '
				.$this->_executable.' clone '.$cloneUrl.' '.basename($this->_location).' 2>&1';
			
			$this->_exec($command);
			
		}
		
	}
	
	public function createFileName($file) {
		
		if (!preg_match('/^\//',$file)) {
			
			$file = '/'.$file;
			
		}
		
		return $this->_location.$file;
		
	}
	
	public function getLocation() {
		
		return $this->_location;
		
	}
	
	public function getContents() {
		
		if (!($this->_folder instanceof Inclusive_Folder)) {
			
			$this->_folder = new Inclusive_Folder('',array('baseName'=>$this->_location));
			
		}
		
		return $this->_folder->getContents();
		
	}
	
	public function addFile($data) {
		
		if (!preg_match('/^\//',$data['folder'])) {
			
			$data['folder'] = '/'.$data['folder'];
			
		}
		
		if (!preg_match('/^\//',$data['name'])) {
			
			$data['name'] = '/'.$data['name'];
			
		}
		
		$fullFileName = ((isset($data['folder'])) ? 
			$data['folder'] : $this->_location).$data['name'];
		
		if (!touch($fullFileName)) {
			
			throw new Zend_Exception('Touch not successful: '.$fullFileName);
			
		}
		
		if (!file_put_contents($fullFileName,$data['content'])) {
			
			throw new Zend_Exception('Put not successful.');
			
		}
		
	}
	
	public function addFolder($data) {
		
		if (!preg_match('/^\//',$data['folder'])) {
			
			$data['folder'] = '/'.$data['folder'];
			
		}
		
		if (!preg_match('/\/$/',$data['folder'])
		    && !preg_match('/^\//',$data['name'])) {
			
			$data['name'] = '/'.$data['name'];
			
		}
		
		$fullFileName = $this->_location.$data['folder'].$data['name'];
		
		if (!mkdir($fullFileName)) {
			
			throw new Zend_Exception('mkdir not successful: '.$fullFileName);
			
		}
		
	}
	
	public function command($command) {
		
		if (preg_match('/^git/',$command)) {
				
	        $command = preg_replace('/^git/',' '.$this->_executable,$command);
	        
	        $command = 'cd '.$this->_location.' && '.$command;
	        
        }
        
        $data = $this->_exec($command);
        
        return $data;
        
	}
	
	protected function _exec($command,&$output=null,&$result=null) {
		
		exec($command,$output,$result);
		
		return array(
		    'command'=>$command,
		    'output'=>$output,
		    'result'=>$result
		    );
		
	}
	
}