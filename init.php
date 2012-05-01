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
 * read config
 */
$configData = parse_ini_file('config.ini', true);

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
try {
    $mongoUrl = $configData['connections']['mongoUrl']
        . '/' . $configData['connections']['mongoDb'];
    $url = parse_url($mongoUrl);
    $mongo = new Mongo($mongoUrl, array('persist' => 'x'));
    $db = $mongo->$configData['connections']['mongoDb'];
    $auth = $db->authenticate(
        $configData['connections']['mongoUser'],
        $configData['connections']['mongoPass']
    );
    $registry->db = $db;
    // check auth
    if (!empty($auth['errmsg'])) {
        throw new Exception($auth['errmsg']);
    }
} catch (Exception $e) {
    echo 'could not establish database connection: ';
    echo $e->getMessage() . PHP_EOL;
    echo 'in ' . $e->getFile() . ' on line ' . $e->getLine() . PHP_EOL;
    echo $e->getTraceAsString();
    die();
}

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