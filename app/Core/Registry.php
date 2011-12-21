<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Rwtt_Core_Registry extends Rwtt_Core_AbstractRegistry
{
    private $_cache = array();
    
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

    public function __isset($name)
    {
        return isset($this->_cache[$name]);
    }

    public function __unset($name)
    {
        unset($this->_cache[$name]);
    }

    public function clear()
    {
        $this->_cache = array();
    }
}
