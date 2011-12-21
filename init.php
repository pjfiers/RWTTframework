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