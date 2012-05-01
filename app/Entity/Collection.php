<?php
/**
 * RWTT v2
 *
 * Mongo db collection base class
 * this sets the framework for entities
 * each entity can has its own collection
 * each entity represents its (to be) stored in its collection
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Entity_Collection
{
    /**
     * name of the collection
     *
     * @var string
     */
    protected $_collectionName = 'entities';
    
    /**
     * Constructor
     * sets the correct collection
     * loads registry
     */
    public function __construct()
    {
        $registry = Rwtt_Registry::getInstance();
        $this->_db = $registry->db;
        $collName = $this->_collectionName;
        $this->_collection = $this->_db->$collName;
        $all = $this->_collection->find();
        foreach ($all as $one) {
            $this->entities[$one['id']] = $one;
        }
    }
}