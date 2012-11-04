<?php

class Inclusive_Model_Google_Checkout_Notification extends Inclusive_Model_Abstract
{

	protected $_niceData = null;

	protected $_rawString = '';
	
	public function __construct(Inclusive_Service_Google_Checkout_Notification $service,array $data) 
	{
		
		parent::__construct($service,$data);
		
		$this->_rawString = $data['content'];
		
		$data = $this->_stringToData($data['content']);
		
		$this->_niceData = $this->_dataToNice($data);
	
	}
	
	public function getAcknowledgementString()
	{
	
		return '<notification-acknowledgment xmlns="http://checkout.google.com/schema/2" serial-number="'.$this->getSerialNumber().'" />';
	
	}
	
	public function getData()
	{
	
		return $this->_data;
		
	}
	
	public function getEmail()
	{
	
		return $this->_niceData['buyer_shipping_address']['email'];
	
	}
	
	public function getFirstItem()
	{
	
		return $this->_niceData['shopping_cart']['items']['item_1'];
	
	}
	
	public function getGoogleOrderNumber()
	{
	
		return $this->_niceData['google_order_number'];
	
	}
	
	public function getNiceData()
	{
	
		return $this->_niceData;
	
	}
	
	public function getOrderTotal()
	{
	
		return $this->_niceData['order_total'][0];
	
	}
	
	public function getOrderTotalCurrency()
	{
	
		return $this->_niceData['order_total']['currency'];
	
	}
	
	public function getSerialNumber()
	{
	
		return $this->_niceData['serial_number'];
	
	}
	
	public function getTimestamp()
	{
	
		return $this->_niceData['timestamp'];
	
	}
	
	public function getTotalChargeAmount()
	{
	
		return $this->_niceData['total_charge_amount'][0];
	
	}
	
	public function getTotalChargeAmountCurrency()
	{
	
		return $this->_niceData['total_charge_amount']['currency'];
	
	}
	
	public function getType()
	{
	
		return $this->_niceData['type'];
	
	}
	
	protected function _stringToData($string)
	{
	
		parse_str($string,$data);
		
		return $data;
	
	}
	
	protected function _dataToNice(array $data)
	{
	
		$nice = array();
		
		foreach ($data as $key => $value)
		{
		
			$nice = $this->_dataToNicePlaceValue($key,$value,$nice);
		
		}
		
		$nice = $this->_dataToNiceReplaceHyphens($nice);
		
		return $nice;
	
	}
	
	protected function _dataToNicePlaceValue($key,$value,array $nice)
	{
	
		if ($key == '_type')
		{
		
			$key = 'type';
		
		}
	
		$parts = explode('_',$key);
		
		$firstKey = $parts[0];
		
		if (count($parts) > 1)
		{
		
			if (isset($nice[$firstKey]))
			{
			
				if (is_array($nice[$firstKey]))
				{
				
					$array = $nice[$firstKey];
					//$array[] = $value;
					
				}
				else 
				{
					
					$array = array($nice[$firstKey]);
					
				}
			
			}
			else 
			{
			
				$array = array();
				//$array[] = $value;
			
			}
			
			$newKey = str_replace($firstKey.'_','',$key);
		
			$array = $this->_dataToNicePlaceValue($newKey,$value,$array);
			
			$nice[$firstKey] = $array;
		
		}
		else 
		{
		
			if (isset($nice[$firstKey]))
			{
			
				if (!is_array($nice[$firstKey]))
				{
				
					$nice[$firstKey] = array($nice[$firstKey]);
					
				}
			
				$nice[$firstKey][] = trim($value);
				
			}
			else 
			{
			
				$nice[$firstKey] = trim($value);
				
			}
		
		}
		
		return $nice;
	
	}
	
	protected function _dataToNiceReplaceHyphens(array $data)
	{
	
		$new = array();
		
		foreach ($data as $key => $value)
		{
		
			if (is_array($value))
			{
			
				$value = $this->_dataToNiceReplaceHyphens($value);
			
			}
			
			$key = str_replace('-','_',$key);
			
			$new[$key] = $value;
		
		}
		
		return $new;
	
	}
	
}