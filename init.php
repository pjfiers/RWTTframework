<?php
/* 
 * bootstrap file
 *
 */

/**
 * autoload files
 */
require_once 'app/Core/Autoloader.php';
$autoloader = new Rwtt_Core_Autoloader('app');

/**
 * setup registry
 */
$registry = Rwtt_Core_Registry::getInstance();
$registry->siteName = 'RWTT: ';

/**
 * setup HTML DOM
 */
include_once('app/Layout.php');

/**
 * setup Router
 */
$registry->router = new Rwtt_Core_Router();
$registry->router->rootPath = '/rwtt_nosql/';
$registry->router->controller = 'index';
$registry->router->load();

/**
 * Setup the database
 */
$mongo = new Mongo();
$db = $mongo->runwiththetorch;
$registry->db = $db;

/**
$id = 'testBlogId1';
/*$ent = new Rwtt_Entity_BlogPost();
$ent->setId($id);
$ent->save();


$ent = new Rwtt_Entity_BlogPost();
if($ent->loadById($id)) {
    $ent->title = 'testing title 123';
    $ent->author = 'PJ';
    $ent->content = 'this is some <br/>' . PHP_EOL
                  . '<strong>HTML</strong> content';
    $ent->save();
} else {
    echo 'id ' . $id . 'not found' . PHP_EOL;
}

var_dump($ent);
echo PHP_EOL . PHP_EOL;
$cursor = $db->blogposts->find();
foreach ($cursor as $doc) {
    var_dump($doc);
}
//$db->entities->remove(array());*/
