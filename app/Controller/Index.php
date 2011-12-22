<?php
/**
 * RWTT v2
 *
 * Index controller
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Controller_Index extends Rwtt_Controller
{
    /**
     * Index Action
     * when no other action is specified
     */
    public function indexAction()
    {
        $this->view->title = 'INDEX PAGE';
    }
}