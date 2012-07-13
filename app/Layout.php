<?php
/**
 * RWTT v2
 *
 * Basic layout
 * Built using DOMDocument
 * Stored in the registry so it can be manipulated at any point in the
 * process
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */

// skeleton
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
    $htmlDom->createElement('nav')
);

$registry->htmlDom = $htmlDom;
$registry->head = $head;
$registry->content = $content;
$registry->nav = $nav;

// head
$title = $htmlDom->createElement('title', $registry->siteName);
$head->appendChild($title);
$registry->head->title = $title;

// stylesheet
$link = Rwtt_Helper_Link::create(
    $registry->baseUrl . 'public/css/default.css', 
    'stylesheet', 
    'text/css'
);
$head->appendChild($link);

// links
$navigation = array(
    'Blog' => 'index'
);

foreach ($navigation as $label => $route) {
    $ahref = $nav->appendChild(
        $htmlDom->createElement('a', $label)
    );
    $ahref->setAttribute('href', $baseUrl . $route);
}