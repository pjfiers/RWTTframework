<?php
/* 
 * bootstrap file
 *
 */
$rootPath = '/rwtt_nosql/';
$baseUrl = 'http://' . $_SERVER['SERVER_NAME'] . $rootPath;
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
 * Setup the database
 */
$mongo = new Mongo();
$db = $mongo->runwiththetorch;
$registry->db = $db;

/**
 * setup HTML DOM
 */
include_once('app/Layout.php');

/**
 * setup Router
 */
$registry->router = new Rwtt_Core_Router();
$registry->rootPath = $rootPath;
$registry->baseUrl = $baseUrl;
$registry->router->controller = 'index';
$registry->router->load();