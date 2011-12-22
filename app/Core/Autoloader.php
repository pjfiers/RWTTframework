<?php
/**
 * RWTT v2
 *
 * Autoloader class
 * this will register every object called
 * after including its file in the app folder
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Core_Autoloader
{
    /**
     * base path where application objects and files are found
     *
     * @var String
     */
    private $_appPath = 'app';

    /**
     * set the app path
     *
     * @param string $appPath
     */
    public  function __construct($appPath)
    {
        $this->_appPath = $appPath;
        spl_autoload_register(array($this, 'loader'));
    }

    /**
     * class loading method
     *
     * @param string $className
     */
    private function loader($className)
    {        
        // remove 'namespace'
        $classPath = str_replace('Rwtt_', '', $className);
        // find go find file
        $classPath = str_replace('_', '/', $classPath);
        $filePath = $this->_appPath . '/' . $classPath . '.php';
        if (!is_readable($filePath)) {
            throw new Exception(
                'Failed loading ' . $className
            );
        } else {
            require_once($filePath);            
        }
       
    }
}
