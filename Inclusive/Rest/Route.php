<?php

class Inclusive_Rest_Route extends Zend_Controller_Router_Route_Module
{
    
    /**
     * @var Zend_Controller_Front
     */
    protected $_front;

    /**
     * Constructor
     *
     * @param Zend_Controller_Front $front Front Controller object
     * @param array $defaults Defaults for map variables with keys as variable names
     * @param array $responders Modules or controllers to receive RESTful routes
     */
    public function __construct(Zend_Controller_Front $front) 
    {
        
        $this->_front      = $front;
        $this->_dispatcher = $front->getDispatcher();
        $this->_defaults = array();
    
    }

    /**
     * Instantiates route based on passed Zend_Config structure
     */
    public static function getInstance(Zend_Config $config)
    {
        
        $frontController = Zend_Controller_Front::getInstance();
        $instance = new self($frontController);
        return $instance;
        
    }

    /**
     * Matches a user submitted request. Assigns and returns an array of variables
     * on a successful match.
     *
     * If a request object is registered, it uses its setModuleName(),
     * setControllerName(), and setActionName() accessors to set those values.
     * Always returns the values as an array.
     *
     * @param Zend_Controller_Request_Http $request Request used to match against this routing ruleset
     * @return array An array of assigned values or a false on a mismatch
     */
    public function match($request, $partial = false)
    {
        
        if (!$request instanceof Zend_Controller_Request_Http)
        {
            
            $request = $this->_front->getRequest();
        
        }
        
        $this->_request = $request;
        $this->_setRequestKeys();

        $path   = $request->getPathInfo();
        $params = $request->getParams();
        $values = array();
        $path   = trim($path, self::URI_DELIMITER);

        if ($path != '') {

            $paths = explode(self::URI_DELIMITER, $path);
            $parts = array();
            
            //Zend_Debug::dump($paths,'paths');
            
            $pathTotal = count($paths);
            $part = array();
            
            foreach ($paths as $path)
            {
            	
            	//Zend_Debug::dump($part,$path);
            	
            	if (isset($part['resource']))
            	{
            	
            		$part['id'] = $path;
            		
            		$parts[] = $part;
            		
            		$part = array();
            	
            	}
            	else 
            	{
            	
            		$part['resource'] = $path;
            	
            	}
            	
            	//Zend_Debug::dump($part,$path);
            	
            }
            
            if (isset($part['resource']))
            {
            
            	$parts[] = $part;
            	
            }
            
            //Zend_Debug::dump($parts,'parts');
            
            $partTotal = count($parts);
            
            $part = array_shift($parts);
            	
    		$values[$this->_moduleKey] = $part['resource'];
    		
            if (count($parts))
            {
            	
            	$values[$this->_controllerKey] = '';
            	
            	while (count($parts)) 
            	{
            		
            		$values[$part['resource'].'_id'] = $part['id'];
            		
            		$part = array_shift($parts);
            		
            		$values[$this->_controllerKey] .= '-'.$part['resource'];
            		
            		if (isset($part['id']))
            		{
            			
            			$values['id'] = $part['id'];
            		
            		}
            	
            	}
            	
            	$values[$this->_controllerKey] = ltrim($values[$this->_controllerKey],'-');
            	
            	if (isset($part['id']))
            	{
            	
            		$values[$this->_actionKey] = 'get';
            	
            	}
            
            }
            else
            {
            
            	$values[$this->_controllerKey] = $part['resource'];
            	
            	if (isset($part['id']))
            	{
            	
            		// GET/PUT/DELETE/HEAD/OPTIONS to Module's Named Resource
            		// /account/:id
            		$values[$this->_actionKey] = 'get';
            		$values['id'] = $part['id'];
            		
            	}
            	
            }
            
            //Store path count for method mapping
            $pathElementCount = count($path);

            // Check for "special get" URI's
            $specialGetTarget = false;
            $idExists = false;

            // Determine Action
            $requestMethod = strtolower($request->getMethod());
            if ($requestMethod != 'get') {
                if ($request->getParam('_method')) {
                    $values[$this->_actionKey] = strtolower($request->getParam('_method'));
                } elseif ( $request->getHeader('X-HTTP-Method-Override') ) {
                    $values[$this->_actionKey] = strtolower($request->getHeader('X-HTTP-Method-Override'));
                } else {
                    $values[$this->_actionKey] = $requestMethod;
                }

                // Map PUT and POST to actual create/update actions
                // based on parameter count (posting to resource or collection)
                switch( $values[$this->_actionKey] ){
                    case 'post':
                        if ($idExists) {
                            $values[$this->_actionKey] = 'put';
                        } else {
                            $values[$this->_actionKey] = 'post';
                        }
                        break;
                    case 'put':
                        $values[$this->_actionKey] = 'put';
                        break;
                }

            } elseif ($specialGetTarget) {
                $values[$this->_actionKey] = $specialGetTarget;
            }

        }
        $this->_values = $values + $params;

        $result = $this->_values + $this->_defaults;

        if ($partial && $result)
            $this->setMatchedPath($request->getPathInfo());
         
        return $result;
    }

    /**
     * Assembles user submitted parameters forming a URL path defined by this route
     *
     * @param array $data An array of variable and value pairs used as parameters
     * @param bool $reset Weither to reset the current params
     * @param bool $encode Weither to return urlencoded string
     * @return string Route path with user submitted parameters
     */
    public function assemble($data = array(), $reset = false, $encode = true)
    {
        if (!$this->_keysSet) {
            if (null === $this->_request) {
                $this->_request = $this->_front->getRequest();
            }
            $this->_setRequestKeys();
        }

        $params = (!$reset) ? $this->_values : array();

        foreach ($data as $key => $value) {
            if ($value !== null) {
                $params[$key] = $value;
            } elseif (isset($params[$key])) {
                unset($params[$key]);
            }
        }

        $params += $this->_defaults;

        $url = '';

        if ($this->_moduleValid || array_key_exists($this->_moduleKey, $data)) {
            if ($params[$this->_moduleKey] != $this->_defaults[$this->_moduleKey]) {
                $module = $params[$this->_moduleKey];
            }
        }
        unset($params[$this->_moduleKey]);

        $controller = $params[$this->_controllerKey];
        unset($params[$this->_controllerKey]);

        // set $action if value given is 'new' or 'edit'
        if (in_array($params[$this->_actionKey], array('new', 'edit'))) {
            $action = $params[$this->_actionKey];
        }
        unset($params[$this->_actionKey]);

        if (isset($params['index']) && $params['index']) {
            unset($params['index']);
            $url .= '/index';
            if (isset($params['id'])) {
                $url .= '/'.$params['id'];
                unset($params['id']);
            }
            foreach ($params as $key => $value) {
                if ($encode) $value = urlencode($value);
                $url .= '/' . $key . '/' . $value;
            }
        } elseif (! empty($action) && isset($params['id'])) {
            $url .= sprintf('/%s/%s', $params['id'], $action);
        } elseif (! empty($action)) {
            $url .= sprintf('/%s', $action);
        } elseif (isset($params['id'])) {
            $url .= '/' . $params['id'];
        }

        if (!empty($url) || $controller !== $this->_defaults[$this->_controllerKey]) {
            $url = '/' . $controller . $url;
        }

        if (isset($module)) {
            $url = '/' . $module . $url;
        }

        return ltrim($url, self::URI_DELIMITER);
    }

    /**
     * Tells Rewrite Router which version this Route is
     *
     * @return int Route "version"
     */
    public function getVersion()
    {
        return 2;
    }

}