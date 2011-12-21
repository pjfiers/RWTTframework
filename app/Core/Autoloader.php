<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Rwtt_Core_Autoloader
{
    private $_appPath = 'app';

    public  function __construct($appPath)
    {
        $this->_appPath = $appPath;
        spl_autoload_register(array($this, 'loader'));
    }

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
