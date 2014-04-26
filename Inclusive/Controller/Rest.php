<?php

abstract class Inclusive_Controller_Rest extends Inclusive_Controller_Action 
{
	
	protected $_allowedMethods = array(
		'DELETE',
		'GET',
		'HEAD',
		'INDEX',
		'OPTIONS',
		'PATCH',
		'POST',
		'PUT'
		);
	
	public function __call($name,$arguments)
	{
	
		if (preg_match('#Action$#',$name))
		{
		
			$action = preg_replace('#Action$#','',$name);
			
			switch ($action) 
			{
				
				case 'delete':
				case 'get':
				case 'head':
				case 'patch':
				case 'put':
					
					$model = $this->getService()
						->fetchOne($this->getRequest()->getParams());
					
					break;
				
				case 'options':
				
					break;
				
				case 'index':
					
					$set = $this->getService()
						->fetchAll($this->getRequest()->getParams());
					
					break;
				
				case 'post':
					
					$model = $this->getService()->fetchNew();
					
					break;
					
				default:
					
					return parent::__call($name,$arguments);
					
					break;
				
			}
			
			$this->_helper->viewRenderer->setNoRender();
			$this->getResponse()->setHeader('Access-Control-Allow-Origin','http://www.reallist.dev',true);
			$this->getResponse()->setHeader('Access-Control-Allow-Methods',implode(',',$this->_allowedMethods),true);
			$this->getResponse()->setHeader('Access-Control-Allow-Headers','accept, content-type',true);
			
			switch ($action) 
			{
				
				case 'delete':
					
					$result = $this->getService()->delete($model);
					
					break;
					
				case 'patch':
				case 'put':
				case 'post':
					
					$model->transform($this->getRequest()->getParams());
					
					break;
				
			}
			
			switch ($action)
			{
				
				case 'head':
				case 'options':
					
					$this->getResponse()->setHeader('Allow',implode(',',$this->_allowedMethods),true);
					
					$this->getResponse()->setBody(null);
					
					break;
				
				case 'get':
				case 'patch':
				case 'put':
				case 'post':
					
					$this->getResponse()->setBody(Zend_Json::encode($model));
					
					break;
					
				case 'index':
					
					$this->getResponse()->setBody(Zend_Json::encode($set));
					
					break;
			
			}
			
			return;
			
		}
		
		return parent::__call($name,$arguments);
	
	}
	
}