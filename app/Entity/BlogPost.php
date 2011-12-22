<?php
/**
 * RWTT v2
 *
 * Mongo db Blogpost entity
 * addes new properties
 * handles specific setters
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Entity_BlogPost extends Rwtt_Entity
{
    protected $_title;
    protected $_content;
    protected $_creationDate;
    protected $_updateDate;
    protected $_author;

    public function  __construct() {
        $this->_collectionName = 'blogposts';
        parent::__construct();        
    }
}
