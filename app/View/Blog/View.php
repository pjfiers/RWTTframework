<?php
/**
 * RWTT v2
 *
 * Index/Index view
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
$htmlDom = $this->_registry->htmlDom;
$title = $this->_registry->head->title;
$titleAppend = $htmlDom->createTextNode($this->title . ' VIEW');
$title->appendChild($titleAppend);

$content = $this->_registry->content;
$h1 = $htmlDom->createElement('h1', $this->title);
$content->appendChild($h1);

$blogContent = $htmlDom->createDocumentFragment();
$blogContent->appendXML($this->content);

$contentDiv = $htmlDom->createElement('div');
$contentDiv->setAttribute('class', 'blogContent');
$contentDiv->appendChild($blogContent);
$content->appendChild($contentDiv);