<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
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
