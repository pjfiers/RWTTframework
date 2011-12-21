<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Rwtt_Core_Router
{
    private $_registry;
    private $_path;
    private $_args;
    public $rootPath;
    public $controller;
    public $action;

    public function __construct()
    {
        $this->_registry = Rwtt_Core_Registry::getInstance();
        $route = str_replace($this->rootPath, '', $_SERVER['REQUEST_URI']);        
    }

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

    private function _getRoute()
    {
        $route = str_replace($this->rootPath, '', $_SERVER['REQUEST_URI']);
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
        
    }
}
