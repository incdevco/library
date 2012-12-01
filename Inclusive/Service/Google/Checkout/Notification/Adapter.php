<?php

abstract class Inclusive_Service_Google_Checkout_Notification_Adapter extends Inclusive_Service_Adapter_Table
{

	protected $_productionMerchantId = null;
	
	protected $_productionMerchantKey = null;

	protected $_tableClass = 'Inclusive_Service_Google_Checkout_Notification_Table';
	
	protected $_sandboxMerchantId = null;
	
	protected $_sandboxMerchantKey = null;
	
	public function add(array $clean)
	{
	
		$result = $this->getTable()
			->insert($clean);
			
		if ($result)
		{
		
			return $result;
			
		}
		
		return $this->_throw('No Notification Added');
	
	}
	
	abstract function authorizationAmount(Inclusive_Model_Google_Checkout_Notification $notification);
	
	abstract function chargeAmount(Inclusive_Model_Google_Checkout_Notification $notification);
	
	abstract function chargebackAmount(Inclusive_Model_Google_Checkout_Notification $notification);
	
	public function delete(array $clean)
	{
	
		$where = array(
			'serial_number = ?'=>$clean['serial_number']
			);
		
		$result = $this->getTable()
			->delete($where);
			
		if ($result)
		{
				
			return $result;
				
		}
		
		return $this->_throw('No Notification Deleted');
	
	}
	
	public function edit(array $clean)
	{
	
		$where = array(
			'serial_number = ?'=>$clean['serial_number']
			);
			
		unset($clean['serial_number']);
	
		$result = $this->getTable()
			->update($clean,$where);
			
		if ($result)
		{
		
			return $result;
			
		}
		
		return $this->_throw('No Notification Edited');
	
	}
	
	public function fetchAll()
	{
	
		$result = $this->getTable()
			->fetchAll();
			
		$class = $this->getService()
			->getSetClass();
			
		return new $class(
			$this->getService(),
			$result->toArray()
			);
	
	}
	
	public function fetchOne(array $clean)
	{
	
		$where = array(
			'serial_number = ?'=>$clean['serial_number']
			);
		
		$result = $this->getTable()
			->fetchRow($where);
			
		if ($result)
		{
				
			$class = $this->getService()
				->getModelClass();
				
			return new $class(
				$this->getService(),
				$result->toArray()
				);
				
		}
		
		return $this->_throw('No Notification Found');
	
	}
	
	public function getMerchantId()
	{
	
		if (APPLICATION_ENV == 'production')
		{
		
			return $this->_productionMerchantId;
		
		}
		else 
		{
		
			return $this->_sandboxMerchantId;
		
		}
	
	}
	
	public function getMerchantKey()
	{
	
		if (APPLICATION_ENV == 'production')
		{
		
			return $this->_productionMerchantKey;
		
		}
		else 
		{
		
			return $this->_sandboxMerchantKey;
		
		}
	
	}
	
	public function getUrl()
	{
	
		if (APPLICATION_ENV == 'production')
		{
		
			$url = 'https://checkout.google.com/api/checkout/v2/reportsForm/Merchant/';
			
		}
		else 
		{
		
			$url = 'https://sandbox.google.com/checkout/api/checkout/v2/reportsForm/Merchant/';
			
		}
		
		return $url . $this->getMerchantId();
		
	}
	
	abstract function newOrder(Inclusive_Model_Google_Checkout_Notification $notification);
	
	abstract function orderStateChange(Inclusive_Model_Google_Checkout_Notification $notification);
	
	abstract function refundAmount(Inclusive_Model_Google_Checkout_Notification $notification);
	
	abstract function riskInformation(Inclusive_Model_Google_Checkout_Notification $notification);
	
	public function serialNumber(array $clean)
	{
	
		$url = $this->getUrl();
		
		$post = array(
			'_type'=>'notification-history-request',
			'serial-number'=>$clean['serial_number']
			);
		
		$client = new Zend_Http_Client($url);
		$client->setAuth($this->getMerchantId(),$this->getMerchantKey());
		$client->setParameterPost($post);
		
		$response = $client->request('POST');
		
		$data = array(
			'serial_number'=>$clean['serial_number'],
			'content'=>$response->getBody()
			);
		
		try 
		{
		
			$notification = $this->fetchOne($data);
			
		}
		catch (Inclusive_Service_Exception $e)
		{
			
			$class = $this->getService()
				->getModelClass();
				
			$notification = new $class(
				$this->getService(),
				$data
				);
			
			$this->add($notification->toArray());
			
		
		}
		
		if ($notification->getType() == 'new-order-notification')
		{
		
			$result = $this->newOrder($notification);
			
		}
		elseif ($notification->getType() == 'order-state-change-notification')
		{
		
			$result = $this->orderStateChange($notification);
		
		}
		elseif ($notification->getType() == 'risk-information-notification')
		{
		
			$result = $this->riskInformation($notification);
		
		}
		elseif ($notification->getType() == 'authorization-amount-notification')
		{
		
			$result = $this->authorizationAmount($notification);
		
		}
		elseif ($notification->getType() == 'charge-amount-notification')
		{
		
			$result = $this->chargeAmount($notification);
		
		}
		elseif ($notification->getType() == 'refund-amount-notification')
		{
		
			$result = $this->refundAmount($notification);
		
		}
	
		try 
		{
		
			$this->edit(array(
				'serial_number'=>$notification->getSerialNumber(),
				'status'=>'Handled'
				));
				
		}
		catch (Inclusive_Service_Exception $e)
		{
		
		
		
		}
	
		return $notification;
		
	}
	
}