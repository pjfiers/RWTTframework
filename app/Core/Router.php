<?php
/**
 * RWTT v2
 *
 * Router class
 * The router fetches the path that is requested
 * and splits it into controllers, actions and more
 * afterwards it will load the correct controller
 * call the requested action
 * and load the default view that matches the controller/action
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Core_Router
{
    /**
     * instance of the registry
     *
     * @var Rwtt_Core_Registry
     */
    private $_registry;
    /**
     * arguments that are requested
     *
     * @var array
     */
    private $_args = array();
    /**
     * called controller
     *
     * @var string
     */
    public $controller;
    /**
     * called method
     *
     * @var string
     */
    public $action;

    /**
     * Constructor
     * inits object
     */
    public function __construct()
    {
        $this->_registry = Rwtt_Core_Registry::getInstance();
    }

    /**
     * Loader
     * Calls the requested controller/method and includes its view
     */
    public function load()
    {
        $this->_getRoute();
        $class = 'Rwtt_Controller_' . ucfirst($this->controller);
        $controller = new $class;

        if (!is_callable(array($controller, $this->action))) {
            $action = 'indexAction';
        } else {
            $action = $this->action . 'Action';
        }

        $controller->$action();
        $this->_registry->view->load();
    }

    /**
     * Gets and sets the route into the registry
     * Also sets arguments seperately
     */
    private function _getRoute()
    {
        $route = str_replace($this->_registry->rootPath, '', $_SERVER['REQUEST_URI']);
        $routeParts = explode('/', $route);
        if (empty($route)) {
            $route = 'index/index';
            $routeParts = explode('/', $route);
        } else {            
            $this->controller = $routeParts[0];
            if (isset($routeParts[1])) {
                $this->action = strtolower($routeParts[1]);
                $routeParts[1] = 'index';
            }
        }
        if (empty($this->controller)) {
            $this->controller = 'index';
        }
        if (empty($this->action)) {
            $this->action = 'index';
        }
        $this->_registry->route = $routeParts;
        // split to arguments
        unset($routeParts[0], $routeParts[1]);
        if (empty($routeParts)) {
            $routeParts = array();
        }
        $this->_registry->args = $routeParts;
        
    }
}
