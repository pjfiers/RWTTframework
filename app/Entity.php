<?php
/**
 * RWTT v2
 *
 * Mongo db entity base class
 * this sets the framework for entities
 * each entity can has its own collection
 * each entity represents its (to be) stored in its collection
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
class Rwtt_Entity
{
    /**
     * list of default properties that do not represent anything in
     * its mongo document
     *
     * @var array
     */
    private $_excludeProps = array(
        '_db',
        '_collectionName',
        '_collection',
        '_mongoId',
        '_excludeProps'
    );
    /**
     * MongoDb database connection
     *
     * @var MongoDb
     */
    private $_db;
    /**
     * collection the entity belongs to
     *
     * @var MongoCollection
     */
    private $_collection;
    /**
     * MongoDb's unique ID hash
     *
     * @var MongoId
     */
    private $_mongoId;
    /**
     * name of the collection
     *
     * @var string
     */
    protected $_collectionName = 'entities';
    /**
     * Rwtt unique ID
     *
     * @var string
     */
    protected $_id;

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
    }

    /**
     * Saves the entity to the collection
     * Parses properties to document variables
     * Updates or creates new document based on Rwtt ID
     *
     * @return void
     */
    public function save()
    {
        if ($this->_id !== '' && $this->_id !== null) {
            $result = $this->_collection->findOne(
                 array('id' => $this->_id),
                 array('id')
            );

            // get all props
            $allProps = get_class_vars(get_class($this));
            // but not the default ones
            foreach ($this->_excludeProps as $prop) {
                unset($allProps[$prop]);
            }

            // get all data
            $data = array();
            foreach ($allProps as $prop => $val) {
                $propDbName = str_replace('_', '', $prop);
                $data[$propDbName] = $this->$prop;
            }

            // save or update
            if ($this->_mongoId === null) {
                $this->_collection->save($data);
            } else {
                $this->_collection->update(
                    array(
                        '_id' => $this->_mongoId
                    ),
                    $data
                );
            }
        }
    }

    /**
     * Load an entity from the collectio by Rwtt ID
     *
     * @param string $id
     *
     * @return bool
     */
    public function loadById($id)
    {
        $result = $this->_collection->findOne(
             array('id' => $id),
             array('id')
        );
        if ($result === null) {
            return false;
        } else {
            $this->_mongoId = $result['_id'];
            $this->_id = $result['id'];
            return true;
        }
    }

    /**
     * Sets unique RWTT ID
     *
     * @param string $id
     *
     * @return bool
     */
    public function setId($id)
    {
        if (trim($id)!=='') {
            // id must be unique
            $result = $this->_collection->findOne(
                 array('id' => $id),
                 array('id')
            );
            if ($result === null) {
                $this->_id = $id;
            } else {
                throw new Exception('id ' . $id . ' already exists');
            }
        } else {
             throw new Exception('id ' . $id . ' cannot be empty');
        }
    }

    /**
     * magic setter
     * calls its setVar method if exists
     * if not, creates or sets a new property
     *
     * @param string $var
     * @param string $val
     *
     * @return void
     */
    public function __set($var, $val)
    {
        $methodName =  'set' . ucFirst(strtolower($var));
        $propName = '_' . strtolower($var);
        $objName = get_class($this);
        if (method_exists($objName, $methodName)) {
            $this->$methodName($val);
        } elseif (property_exists($objName, $propName)) {
            $this->$propName = $val;
        } else {
             throw new Exception(
                $var . ' is not a valid property of ' . $objName
            );
        }
    }

}
