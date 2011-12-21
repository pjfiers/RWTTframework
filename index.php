<?php
/**
 * INDEX
 */
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once 'init.php';

/**
 * all the magick happpened
 * now write the HTML
 */
echo $registry->htmlDom->saveHTML();