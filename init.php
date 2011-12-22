<?php
/**
 * RWTT v2
 *
 * Initiation  file, sets defaults and loads required objects in the right order
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */

/**
 * pathing vars
 */
$rootPath = '/rwtt_nosql/';
$baseUrl = 'http://' . $_SERVER['SERVER_NAME'] . $rootPath;

/**
 * autoload files
 */
require_once 'app/Autoloader.php';
$autoloader = new Rwtt_Autoloader('app');

/**
 * setup registry
 */
$registry = Rwtt_Registry::getInstance();
$registry->siteName = 'RWTT: ';

/**
 * Setup the database
 */
$mongo = new Mongo();
$db = $mongo->runwiththetorch;
$registry->db = $db;

/**
 * setup HTML DOM and base layout
 */
include_once('app/Layout.php');

/**
 * setup Router
 */
$registry->router = new Rwtt_Router();
$registry->rootPath = $rootPath;
$registry->baseUrl = $baseUrl;
$registry->router->controller = 'index';
$registry->router->load();