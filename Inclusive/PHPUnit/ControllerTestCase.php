<?php

class Inclusive_PHPUnit_ControllerTestCase extends Inclusive_PHPUnit_TestCase 
{

	protected $_request = null;
	
	protected $_response = null;

	public function setUp()
	{
	
		parent::setUp();
		
		// redirector should not exit
        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
        $redirector->setExit(false);

        // json helper should not exit
        $json = Zend_Controller_Action_HelperBroker::getStaticHelper('json');
        $json->suppressExit = true;
	
	}

    /**
     * Assert that the last handled request used the given module
     *
     * @param  string $module
     * @param  string $message
     * @return void
     */
    public function assertModule($module, $message = '')
    {
        $this->_incrementAssertionCount();
        if ($module != $this->getRequest()->getModuleName()) {
            $msg = sprintf('Failed asserting last module used <"%s"> was "%s"',
                $this->getRequest()->getModuleName(),
                $module
            );
            if (!empty($message)) {
                $msg = $message . "\n" . $msg;
            }
            $this->fail($msg);
        }
    }

    /**
     * Assert that the last handled request did NOT use the given module
     *
     * @param  string $module
     * @param  string $message
     * @return void
     */
    public function assertNotModule($module, $message = '')
    {
        $this->_incrementAssertionCount();
        if ($module == $this->getRequest()->getModuleName()) {
            $msg = sprintf('Failed asserting last module used was NOT "%s"', $module);
            if (!empty($message)) {
                $msg = $message . "\n" . $msg;
            }
            $this->fail($msg);
        }
    }

    /**
     * Assert that the last handled request used the given controller
     *
     * @param  string $controller
     * @param  string $message
     * @return void
     */
    public function assertController($controller, $message = '')
    {
        $this->_incrementAssertionCount();
        if ($controller != $this->getRequest()->getControllerName()) {
            $msg = sprintf('Failed asserting last controller used <"%s"> was "%s"',
                $this->getRequest()->getControllerName(),
                $controller
            );
            if (!empty($message)) {
                $msg = $message . "\n" . $msg;
            }
            $this->fail($msg);
        }
    }

    /**
     * Assert that the last handled request did NOT use the given controller
     *
     * @param  string $controller
     * @param  string $message
     * @return void
     */
    public function assertNotController($controller, $message = '')
    {
        $this->_incrementAssertionCount();
        if ($controller == $this->getRequest()->getControllerName()) {
            $msg = sprintf('Failed asserting last controller used <"%s"> was NOT "%s"',
                $this->getRequest()->getControllerName(),
                $controller
            );
            if (!empty($message)) {
                $msg = $message . "\n" . $msg;
            }
            $this->fail($msg);
        }
    }

    /**
     * Assert that the last handled request used the given action
     *
     * @param  string $action
     * @param  string $message
     * @return void
     */
    public function assertAction($action, $message = '')
    {
        $this->_incrementAssertionCount();
        if ($action != $this->getRequest()->getActionName()) {
            $msg = sprintf('Failed asserting last action used <"%s"> was "%s"', $this->getRequest()->getActionName(), $action);
            if (!empty($message)) {
                $msg = $message . "\n" . $msg;
            }
            $this->fail($msg);
        }
    }

    /**
     * Assert that the last handled request did NOT use the given action
     *
     * @param  string $action
     * @param  string $message
     * @return void
     */
    public function assertNotAction($action, $message = '')
    {
        $this->_incrementAssertionCount();
        if ($action == $this->getRequest()->getActionName()) {
            $msg = sprintf('Failed asserting last action used <"%s"> was NOT "%s"', $this->getRequest()->getActionName(), $action);
            if (!empty($message)) {
                $msg = $message . "\n" . $msg;
            }
            $this->fail($msg);
        }
    }

    /**
     * Assert that response is a redirect
     *
     * @param  string $message
     * @return void
     */
    public function assertRedirect($message = '')
    {
        $this->_incrementAssertionCount();
        require_once 'Zend/Test/PHPUnit/Constraint/Redirect.php';
        $constraint = new Zend_Test_PHPUnit_Constraint_Redirect();
        $response   = $this->getResponse();
        if (!$constraint->evaluate($response, __FUNCTION__)) {
            $constraint->fail($response, $message);
        }
    }

    /**
     * Assert that response is NOT a redirect
     *
     * @param  string $message
     * @return void
     */
    public function assertNotRedirect($message = '')
    {
        $this->_incrementAssertionCount();
        require_once 'Zend/Test/PHPUnit/Constraint/Redirect.php';
        $constraint = new Zend_Test_PHPUnit_Constraint_Redirect();
        $response   = $this->getResponse();
        if (!$constraint->evaluate($response, __FUNCTION__)) {
            $constraint->fail($response, $message);
        }
    }

    /**
     * Assert that response redirects to given URL
     *
     * @param  string $url
     * @param  string $message
     * @return void
     */
    public function assertRedirectTo($url, $message = '')
    {
        $this->_incrementAssertionCount();
        require_once 'Zend/Test/PHPUnit/Constraint/Redirect.php';
        $constraint = new Zend_Test_PHPUnit_Constraint_Redirect();
        $response   = $this->getResponse();
        if (!$constraint->evaluate($response, __FUNCTION__, $url)) {
            $constraint->fail($response, $message);
        }
    }

    /**
     * Assert that response does not redirect to given URL
     *
     * @param  string $url
     * @param  string $message
     * @return void
     */
    public function assertNotRedirectTo($url, $message = '')
    {
        $this->_incrementAssertionCount();
        require_once 'Zend/Test/PHPUnit/Constraint/Redirect.php';
        $constraint = new Zend_Test_PHPUnit_Constraint_Redirect();
        $response   = $this->getResponse();
        if (!$constraint->evaluate($response, __FUNCTION__, $url)) {
            $constraint->fail($response, $message);
        }
    }

    /**
     * Assert that redirect location matches pattern
     *
     * @param  string $pattern
     * @param  string $message
     * @return void
     */
    public function assertRedirectRegex($pattern, $message = '')
    {
        $this->_incrementAssertionCount();
        require_once 'Zend/Test/PHPUnit/Constraint/Redirect.php';
        $constraint = new Zend_Test_PHPUnit_Constraint_Redirect();
        $response   = $this->getResponse();
        if (!$constraint->evaluate($response, __FUNCTION__, $pattern)) {
            $constraint->fail($response, $message);
        }
    }

    /**
     * Assert that redirect location does not match pattern
     *
     * @param  string $pattern
     * @param  string $message
     * @return void
     */
    public function assertNotRedirectRegex($pattern, $message = '')
    {
        $this->_incrementAssertionCount();
        require_once 'Zend/Test/PHPUnit/Constraint/Redirect.php';
        $constraint = new Zend_Test_PHPUnit_Constraint_Redirect();
        $response   = $this->getResponse();
        if (!$constraint->evaluate($response, __FUNCTION__, $pattern)) {
            $constraint->fail($response, $message);
        }
    }

    /**
     * Assert response code
     *
     * @param  int $code
     * @param  string $message
     * @return void
     */
    public function assertResponseCode($code, $message = '')
    {
        $this->_incrementAssertionCount();
        require_once 'Zend/Test/PHPUnit/Constraint/ResponseHeader.php';
        $constraint = new Zend_Test_PHPUnit_Constraint_ResponseHeader();
        $response   = $this->getResponse();
        if (!$constraint->evaluate($response, __FUNCTION__, $code)) {
            $constraint->fail($response, $message);
        }
    }

    /**
     * Assert response code
     *
     * @param  int $code
     * @param  string $message
     * @return void
     */
    public function assertNotResponseCode($code, $message = '')
    {
        $this->_incrementAssertionCount();
        require_once 'Zend/Test/PHPUnit/Constraint/ResponseHeader.php';
        $constraint = new Zend_Test_PHPUnit_Constraint_ResponseHeader();
        $constraint->setNegate(true);
        $response   = $this->getResponse();
        if (!$constraint->evaluate($response, __FUNCTION__, $code)) {
            $constraint->fail($response, $message);
        }
    }

	public function getRequest()
	{
	
		if ($this->_request === null)
		{
		
			$this->_request = new Zend_Controller_Request_HttpTestCase();
			
		}
		
		return $this->_request;
	
	}
	
	public function getResponse()
	{
	
		if ($this->_response === null)
		{
		
			$this->_response = new Zend_Controller_Response_HttpTestCase();
			
		}
		
		return $this->_response;
	
	}

    /**
     * Increment assertion count
     *
     * @return void
     */
    protected function _incrementAssertionCount()
    {
        $stack = debug_backtrace();
        foreach (debug_backtrace() as $step) {
            if (isset($step['object'])
                && $step['object'] instanceof PHPUnit_Framework_TestCase
            ) {
                if (version_compare(PHPUnit_Runner_Version::id(), '3.3.0', 'lt')) {
                    break;
                } elseif (version_compare(PHPUnit_Runner_Version::id(), '3.3.3', 'lt')) {
                    $step['object']->incrementAssertionCounter();
                } else {
                    $step['object']->addToAssertionCount(1);
                }
                break;
            }
        }
    }
    
}