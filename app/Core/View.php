<?php
/**
 * RWTT v2
 *
 * View loading class
 * handles default properties and magic setter/getters
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Core_View
{
    /**
     * registry instance
     *
     * @var Rwtt_Core_Registry
     */
    private $_registry;
    /**
     * view name
     *
     * @var string
     */
    private $_name;
    /**
     * controller action
     *
     * @var string
     */
    private $_action;
    /**
     * overloaded properties
     *
     * @var array()
     */
    private $_vars = array();

    /**
     * contstructor
     * sets view details
     *
     * @return void
     */
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


    /**
     * Magic method to set a property
     * This adds the variable and value to the var array
     * Overloading enables to store any variable as
     * a property of the registry on the fly
     *
     * @param variablename $var
     * @param value $val
     *
     * @return boolean
     */
    public function __set($var, $val)
    {
        $this->_vars[$var] = $val;
    }

    /**
     * magic get method
     * This fetches the value of a property out of the var array
     * if it does exist
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($var)
    {
        if (isset($this->_vars[$var])) {
            return $this->_vars[$var];
        }
        return null;
    }

    /**
     * Magic method to catch isset
     * Will check if the property exists within the cache
     *
     * @param string $name
     *
     * @return boolean
     */
    public function __isset($name)
    {
        return isset($this->_vars[$name]);
    }

    /**
     * Magic method to catch unset
     * Will remove the property from the cache
     *
     * @param string $name
     *
     * @return void
     */
    public function __unset($name)
    {
        unset($this->_vars[$name]);
    }

    /**
     * loads the correct file
     *
     *
     * @return void
     */
    public function load()
    {
        include_once 'app/View/' . $this->_name . '/' . $this->_action . '.php';
    }
}