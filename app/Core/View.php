<?php
class Rwtt_Core_View
{
    private $_registry;
    private $_name;
    private $_action;
    private $_vars;

    public function __construct()
    {
        $this->_registry = Rwtt_Core_Registry::getInstance();

        // default equals route
        $route = $this->_registry->route;
        if (!empty($route[0])) {
            $this->_name = ucfirst($route[0]);
        } else {
            $this->_name = 'Index';
        }
        if (!empty($route[1])) {
            $this->_action = ucfirst($route[1]);
        } else {
            $this->_action = 'Index';
        }
        $this->_registry->view = $this;
    }

    public function __set($var, $val)
    {
        $this->_vars[$var] = $val;
    }

    public function __get($var)
    {
        if (isset($this->_vars[$var])) {
            return $this->_vars[$var];
        }
        return null;
    }

    public function load()
    {
        include_once 'app/View/' . $this->_name . '/' . $this->_action . '.php';
    }
}