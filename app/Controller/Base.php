<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Abstract Class Rwtt_Controller_Base
{
    protected $_registry;
    public $view;

    public function  __construct() {
        $this->_registry = Rwtt_Core_Registry::getInstance();
        $view = new Rwtt_Core_View();
        $this->view = $view;
    }

    abstract public function indexAction();
}