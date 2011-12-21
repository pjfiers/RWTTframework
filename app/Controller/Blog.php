<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Rwtt_Controller_Blog extends Rwtt_Controller_Base
{
    public function indexAction()
    {
        $this->view->title = 'this be my blog';
    }
}