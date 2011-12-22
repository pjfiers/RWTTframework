<?php
/**
 * RWTT v2
 *
 * Abstract registry object
 * ensures the registries are correctly instanced
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
abstract class Rwtt_AbstractRegistry
{
    /**
     * list of registries
     *
     * @var array
     */
    protected static $_instances = array();

    /**
     * gets the correct registry instance
     *
     * @return Rwtt_Registry
     */
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