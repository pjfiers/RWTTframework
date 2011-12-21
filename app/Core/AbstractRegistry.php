<?php
/* 
 * Registry abstract
 */
abstract class Rwtt_Core_AbstractRegistry
{
    protected static $_instances = array();

    public static function getInstance()
    {
        $class = get_called_class();

        if (!isset(self::$_instances[$class]))
        {
            self::$_instances[$class] = new $class;
        }

        return self::$_instances[$class];
    }

    protected function __construct(){}
    protected function __clone(){}
    abstract public function __set($var, $val);
    abstract public function __get($var);
    abstract public function clear();
}