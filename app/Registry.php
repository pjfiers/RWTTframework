<?php
/**
 * RWTT v2
 *
 * Registry object
 * Used for storing and accessing data throughout the all of the code
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Registry extends Rwtt_AbstractRegistry
{
    /**
     * array where everything is stored
     *
     * @var array
     */
    private $_cache = array();

    /**
     * Magic method to set a property
     * This adds the variable and value to the cache
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
        if (strlen($var) <= 1) {
            $trace = debug_backtrace();
            throw new Exception(
                'Registry variable must have a length of 2 or longer'                
            );
        }

        if ($val===null) {
            $trace = debug_backtrace();
            throw new Exception(
                'Trying to store a unexisting value to the registry'
            );
            $this->_cache[$var] = null;
            return false;
        }
        $this->_cache[$var] = $val;
        return true;
    }

    /**
     * magic get method
     * This fetches the value of a property out of the cache
     * if it does exist
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (!isset($this->_cache[$name])) {
            $trace = debug_backtrace();
            throw new Exception(
                'var ' . $name . ' not found in the registry'
            );
            return null;
        }

        return $this->_cache[$name];
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
        return isset($this->_cache[$name]);
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
        unset($this->_cache[$name]);
    }

    /**
     * Clears everything in the registry cache
     *
     * @return void
     */
    public function clear()
    {
        $this->_cache = array();
    }
}
