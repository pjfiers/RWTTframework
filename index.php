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
echo $registry->htmlDom->saveHTML();