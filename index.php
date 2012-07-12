<?php
/**
 * RWTT v2
 *
 * RWTT's framework and cms code
 * This file only outputs the end result of the HTML
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */

// devmode errors
error_reporting(E_ALL);
ini_set('display_errors', 'on');

/**
 * initiate the app
 */
require_once 'init.php';

/**
 * all the magick happpened
 * now write the HTML
 */
if ($registry->route !== false) {
   echo $registry->htmlDom->saveHTML();
} else {
    // or get contents (WIP)
    $filename = $_SERVER['REQUEST_URI'];
    $filename = str_replace($registry->rootPath, '', $filename);
    if (file_exists($filename) && !is_dir($filename)) {
        $contents = file_get_contents($filename);
        print $contents;
    } else {
        header('location: ' . $registry->baseUrl . '404');
        exit;
    }
}