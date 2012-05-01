<?php
/**
 * RWTT v2
 *
 * Blog controller
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Controller_Blog extends Rwtt_Controller
{
    /**
     * View Action
     * when no other action is specified
     */
    public function viewAction()
    {
        $blogpostId = $this->_registry->args[0];
        $blogpost = new Rwtt_Entity_BlogPost();
        $blogpost->loadById($blogpostId);
        $this->view->title = $blogpost->title;
        $this->view->content = $blogpost->content;
    }

    public function indexAction()
    {
        $blogposts = new Rwtt_Entity_Collection_BlogPost();
        foreach ($blogposts as $post) {
            $this->view->items = $post;
        }
        $this->view->title = 'Blog Index';
    }
}