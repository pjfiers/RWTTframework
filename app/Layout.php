<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$htmlDom = new DOMDocument();
$htmlDom->formatOutput = true;
$root = $htmlDom->appendChild(
    $htmlDom->createElement('html')
);
$head = $root->appendChild(
    $htmlDom->createElement('head')
);
$body = $root->appendChild(
    $htmlDom->createElement('body')
);
$content = $body->appendChild(
    $htmlDom->createElement('div')
);
$content->setAttribute('id', 'content');
$nav = $body->appendChild(
    $htmlDom->createElement('div')
);
$nav->setAttribute('id', 'nav');

$registry->htmlDom = $htmlDom;
$registry->head = $head;
$registry->content = $content;
$registry->nav = $nav;

$title = $htmlDom->createElement('title', $registry->siteName);
$head->appendChild($title);
$registry->head->title = $title;

$list = $htmlDom->createElement('ul');
$nav->appendChild($list);
$navigation = array(
    'Home' => 'index',
    'Blog' => 'blog'
);
foreach ($navigation as $label => $route) {
    $li = $list->appendChild(
        $htmlDom->createElement('li')
    );
    $ahref = $li->appendChild(
        $htmlDom->createElement('a', $label)
    );
    $ahref->setAttribute('href', $route);
}