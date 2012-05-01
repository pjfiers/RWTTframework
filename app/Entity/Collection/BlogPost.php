<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Rwtt_Entity_Collection_BlogPost extends Rwtt_Entity_Collection
{
    public function  __construct() {
        $this->_collectionName = 'blogposts';
        parent::__construct();        
    }
}
