<?php

class Inclusive_CodeGenerator_Writer
{

	public function writeFile($path,$content)
	{
		
		//echo $path,"\n";
		
		$directory = dirname($path);
		
		$this->makeDirectory($directory,true);
		
		return file_put_contents($path,$content);
	
	}
	
	public function makeDirectory($path,$recursive=false)
	{
	
		if (!file_exists($path))
		{
		
			mkdir($path,0777,$recursive);
		
		}
	
	}

}