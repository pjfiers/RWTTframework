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
        $blogposts = new Rwtt_Entity_Collection_BlogPost();
        foreach ($blogposts as $post) {
            $this->view->items = $post;
        }
        $this->view->title = 'Blog';
    }
    
}