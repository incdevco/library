<?php

use Aws\S3\S3Client;
	
class Inclusive_Log_Writer_S3 extends Zend_Log_Writer_Abstract
{
	
	protected $_config = null;
	
	protected $_client = null;
	
	public function __construct(array $config=array())
	{
	
		$this->_config = $config;
	
	}
	
	static public function factory($config)
    {
		
        return new self($config);
    	
    }
	    
	protected function _getS3Client()
	{
	
		if (null === $this->_client)
		{
		
			// Create an Amazon S3 client object
			$client = S3Client::factory(array(
			    'key'    => $this->_config['access_key'],
			    'secret' => $this->_config['secret_key']
			));
			 
			// Register the stream wrapper from a client object
			$client->registerStreamWrapper();
		
		}
		
		return $this->_client;
	
	}
	
	protected function _write($event)
	{
	 
		$client = $this->_getS3Client();
		
		$bucket = 'inclusivedvhostingfilestorage';
		$key = 'rjanalytical/logs/'.date('n-j-Y',REQUEST_TIME).'.log';
		
		$object = "s3://{$bucket}/{$key}";
		
		file_put_contents($object,Zend_Json::encode($event), FILE_APPEND);
		
	}

}