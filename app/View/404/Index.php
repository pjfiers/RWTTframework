<?php
/**
 * RWTT v2
 *
 * Index/Index view
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
header('HTTP/1.0 404 Not Found');
$htmlDom = $this->_registry->htmlDom;
$title = $this->_registry->head->title;
$titleAppend = $htmlDom->createTextNode($this->title);
$title->appendChild($titleAppend);

$content = $this->_registry->content;
$h1 = $htmlDom->createElement('h1', $this->title);
$content->appendChild($h1);