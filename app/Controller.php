<?php
/**
 * RWTT v2
 *
 * Abstract Base controller for extension
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
Abstract Class Rwtt_Controller
{
    /**
     * instance of the registry
     *
     * @var Rwtt_Core_Registry
     */
    protected $_registry;

    /**
     * view object
     *
     * @var Rwtt_Core_View
     */
    public $view;

    /**
     * Constructor
     */
    public function  __construct() {
        $this->_registry = Rwtt_Core_Registry::getInstance();
        $view = new Rwtt_Core_View();
        $this->view = $view;
    }

    /**
     * Abstract index action
     * always required
     */
    abstract public function indexAction();
}