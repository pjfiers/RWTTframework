<?php
/**
 * RWTT v2
 *
 * About/Index view
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
$htmlDom = $this->_registry->htmlDom;
$content = $this->_registry->content;
$h1 = $htmlDom->createElement('h1', 'About');
$content->appendChild($h1);

// text
$textContent = 'the about page';
$content->appendChild($htmlDom->createElement('p', $textContent));