<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Rwtt_Entity
{
    private $_excludeProps = array(
        '_db',
        '_collectionName',
        '_collection',
        '_mongoId',
        '_excludeProps'
    );
    private $_db;
    private $_collection;
    private $_mongoId;
    protected $_collectionName = 'entities';
    protected $_id;
    
    public function __construct()
    {
        $registry = Rwtt_Core_Registry::getInstance();
        $this->_db = $registry->db;
        $collName = $this->_collectionName;
        $this->_collection = $this->_db->$collName;
    }

    public function save()
    {
        if ($this->_id != '' && $this->_id != null) {
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
