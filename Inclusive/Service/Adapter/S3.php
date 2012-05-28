<?php

class Inclusive_Service_Adapter_S3
	extends Inclusive_Service_Adapter_Abstract
{

	protected $_name = null;
	
	protected $_s3Service = null;
	
	public function add(array $data)
	{
	
		// Add Document to S3 via api
	
	}
	
	public function delete(array $data)
	{
	
		// Delete Document from S3 via api
	
	}
	
	public function edit(array $data)
	{
	
		// Edit Document on S3 via api
	
	}
	
	public function fetch(array $data)
	{
	
		// Fetch Document(s) on S3 via api
	
	}
	
	public function getS3Service()
	{
	
		if (!($this->_s3Service 
			instanceof Inclusive_Service_Amazon_S3))
		{
		
			$this->setS3Service(
				new Inclusive_Service_Amazon_S3()
				);
		
		}
		
		return $this->_s3Service;
	
	}
	
	public function setS3Service(
		Inclusive_Service_Amazon_S3 $service
	)
	{
	
		$this->_s3Service = $service;
		
		return $this;
		
	}

}