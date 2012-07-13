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
$titleAppend = $htmlDom->createTextNode($this->title);
$title->appendChild($titleAppend);

$content = $this->_registry->content;
$h1 = $htmlDom->createElement('h1', $this->title);
$content->appendChild($h1);
foreach ($this->items as $item) {
    $h2 = $htmlDom->createElement('h2');
    $link = $htmlDom->createElement('a', $item['title']);
    $link->setAttribute('href', 'blog/view/' . $item['id']);
    $h2->appendChild($link);
    $content->appendChild($h2);
    $dateString = 'created on: ' . $item['_creationDate'];
    $date = $content->appendChild(
        $htmlDom->createElement('p', $dateString)
    );
    $date->setAttribute('class', 'date');
    $fragment = $htmlDom->createDocumentFragment();    
    $fragment->appendXML($item['content']);
    $div = $htmlDom->createElement('div');
    $div->setAttribute('class', 'blogpostt');
    $div->appendChild($fragment);
    $content->appendChild($div);
}